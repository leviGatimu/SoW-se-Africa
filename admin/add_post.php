<?php
session_start();
if(!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }
include '../includes/db_connect.php';

// --- SMART CONTENT PARSER ---
$imported_content = "";
$imported_title = "";

// 1. Helper: Format raw text into nice HTML
function format_as_blog_post($raw_text) {
    $lines = preg_split('/\r\n|\r|\n/', $raw_text);
    $html_output = "";
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line)) continue;
        // Detect Heading (Short line, no end punctuation)
        if (strlen($line) < 60 && !preg_match('/[.,;]$/', $line)) {
            $html_output .= "<h2>" . htmlspecialchars($line) . "</h2>";
        } else {
            $html_output .= "<p>" . htmlspecialchars($line) . "</p>";
        }
    }
    return $html_output;
}

// 2. Helper: Read Word (.docx)
function read_docx($filename){
    $zip = new ZipArchive;
    $output_text = "";
    if ($zip->open($filename) === true) {
        if (($index = $zip->locateName('word/document.xml')) !== false) {
            $xml_data = $zip->getFromIndex($index);
            $xml_data = str_replace('</w:p>', "\n", $xml_data); 
            $output_text = strip_tags($xml_data);
        }
        $zip->close();
    }
    return $output_text;
}

// 3. Helper: Read PDF (Native PHP)
function read_pdf($filename) {
    $content = file_get_contents($filename);
    $text = "";
    
    // Get all text objects in the PDF
    $objects = array();
    if (preg_match_all('/<<.*?>>/s', $content, $objects)) {
        // Iterate over objects to find text streams
        foreach ($objects[0] as $object) {
            // Check for FlateDecode (Compressed text)
            if (strpos($object, '/FlateDecode') !== false) {
                $stream_start = strpos($content, 'stream', strpos($content, $object)) + 6;
                $stream_end = strpos($content, 'endstream', $stream_start);
                $stream = substr($content, $stream_start, $stream_end - $stream_start);
                
                // Try to decompress
                $decoded = @gzuncompress(trim($stream));
                if ($decoded) {
                    // Extract text inside parentheses (...)Tj or (...) Tj
                    if(preg_match_all('/\((.*?)\) ?Tj/', $decoded, $matches)) {
                        foreach($matches[1] as $match) {
                            $text .= $match . " ";
                        }
                        $text .= "\n"; // New line per block
                    }
                    // Handle TJ arrays [ (text) -10 (text) ] TJ
                    elseif(preg_match_all('/\[(.*?)\] ?TJ/', $decoded, $matches)) {
                        foreach($matches[1] as $match) {
                            // Clean up the array syntax
                            $clean = preg_replace('/\((.*?)\)/', '$1', $match); // Keep text in parens
                            $clean = preg_replace('/<.*?>/', '', $clean);       // Remove hex
                            $clean = preg_replace('/-?\d+(\.\d+)?/', '', $clean); // Remove spacing numbers
                            $text .= $clean . " ";
                        }
                        $text .= "\n";
                    }
                }
            }
        }
    }

    // Fallback: If compression failed, try raw extraction (rare for modern PDFs)
    if (empty($text)) {
        if(preg_match_all('/\((.*?)\) ?Tj/', $content, $matches)) {
            $text = implode(' ', $matches[1]);
        }
    }
    
    return $text;
}


// HANDLE IMPORT
if(isset($_POST['import_doc'])) {
    if(isset($_FILES['doc_file']['name']) && $_FILES['doc_file']['name'] != "") {
        $file_ext = strtolower(pathinfo($_FILES['doc_file']['name'], PATHINFO_EXTENSION));
        $temp_file = $_FILES['doc_file']['tmp_name'];
        $raw_text = "";
        $imported_title = pathinfo($_FILES['doc_file']['name'], PATHINFO_FILENAME);

        // Switch based on extension
        if($file_ext == 'docx') {
            $raw_text = read_docx($temp_file);
        } 
        elseif($file_ext == 'txt') {
            $raw_text = file_get_contents($temp_file);
        }
        elseif($file_ext == 'pdf') {
            $raw_text = read_pdf($temp_file);
        } 
        else {
            $error = "File type not supported. Use .docx, .pdf, or .txt";
        }

        if(!empty($raw_text)) {
            $imported_content = format_as_blog_post($raw_text);
            $imported_title = ucwords(str_replace(['_', '-'], ' ', $imported_title));
        } elseif(empty($error)) {
            $error = "Could not extract text. If this is a PDF, ensure it's not a scanned image.";
        }
    }
}

// HANDLE PUBLISH
if(isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $category = mysqli_real_escape_string($conn, $_POST['category']); 
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    
    $image = ""; 
    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        $image = $_FILES['image']['name'];
        $target = "../uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    $sql = "INSERT INTO posts (title, category, image, content) VALUES ('$title', '$category', '$image', '$content')";
    
    if(mysqli_query($conn, $sql)) {
        header("Location: dashboard.php");
    } else {
        $error = "Database Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Write New Article | SoW!SE Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>
    <script>
      tinymce.init({
        selector: '#content-editor',
        height: 600,
        menubar: false,
        plugins: 'link image code lists table',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter | bullist numlist | link table',
        content_style: 'body { font-family:Inter,sans-serif; font-size:16px; color:#334155; line-height:1.8; padding: 20px; } h2 { color: #0f172a; margin-top: 30px; } p { margin-bottom: 20px; }'
      });
    </script>
</head>
<body style="background-color: #f8fafc;">

    <nav class="admin-navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <i class="fa-solid fa-feather-pointed"></i> SoW!SE <span>Admin</span>
            </div>
            <div class="nav-links">
                <a href="dashboard.php"><i class="fa-solid fa-arrow-left"></i> Back to Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="main-container" style="max-width: 900px; margin-top: 40px;">

        <div class="import-card">
            <div class="import-header">
                <div class="icon-circle"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
                <div class="import-text">
                    <h3>Smart Import</h3>
                    <p>Upload a <b>PDF</b>, <b>Word Doc</b>, or <b>Text File</b>. We'll format it for you.</p>
                </div>
            </div>
            
            <form method="POST" enctype="multipart/form-data" class="import-form">
                <div class="file-drop-zone">
                    <input type="file" name="doc_file" id="doc_file" accept=".docx, .pdf, .txt" required onchange="this.form.submit()">
                    <span class="drop-text"><i class="fa-solid fa-cloud-arrow-up"></i> Select File to Convert</span>
                </div>
                <input type="hidden" name="import_doc" value="1">
            </form>
            
            <?php if(isset($error)) echo "<div class='error-msg'><i class='fa-solid fa-triangle-exclamation'></i> $error</div>"; ?>
        </div>

        <div class="card editor-card">
            <div class="card-header">
                <h2>Write New Article</h2>
            </div>

            <form method="POST" enctype="multipart/form-data" class="editor-form">
                
                <div class="form-group">
                    <label>Article Title</label>
                    <input type="text" name="title" class="form-control lg" 
                           placeholder="Enter title..." 
                           value="<?php echo htmlspecialchars($imported_title); ?>" required>
                </div>

                <div class="form-row">
                    <div class="form-group half">
                        <label>Category</label>
                        <select name="category" class="form-select">
                            <option value="News & Updates">News & Updates</option>
                            <option value="Success Story">Success Story</option>
                            <option value="Event">Event / Workshop</option>
                            <option value="Announcement">Announcement</option>
                        </select>
                    </div>
                    <div class="form-group half">
                        <label>Featured Image</label>
                        <div class="file-upload-box">
                            <input type="file" name="image" id="file-input">
                            <label for="file-input"><i class="fa-solid fa-image"></i> Choose Image</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Content Body</label>
                    <textarea id="content-editor" name="content"><?php echo $imported_content; ?></textarea>
                </div>

                <div class="form-actions">
                    <a href="dashboard.php" class="btn-cancel">Discard</a>
                    <button type="submit" name="submit" class="btn-primary-lg">
                        <i class="fa-solid fa-paper-plane"></i> Publish Now
                    </button>
                </div>

            </form>
        </div>
    </div>

</body>
</html>