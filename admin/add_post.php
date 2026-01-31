<?php
session_start();
if(!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }
include '../includes/db_connect.php';

// --- FIXED DOCUMENT PARSER ---
$imported_content = "";
$imported_title = "";

function read_docx($filename){
    $striped_content = '';
    $zip = new ZipArchive;
    
    // Open the archive
    if ($zip->open($filename) === true) {
        // Locate the content file inside the Word Doc
        if (($index = $zip->locateName('word/document.xml')) !== false) {
            $data = $zip->getFromIndex($index);
            
            // Extract text from XML
            $xml = new DOMDocument();
            $xml->loadXML($data, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
            $striped_content = strip_tags($xml->saveXML());
        }
        // CRITICAL FIX: Only close once!
        $zip->close();
    }
    return $striped_content;
}

// HANDLE FILE IMPORT
if(isset($_POST['import_doc'])) {
    if(isset($_FILES['doc_file']['name']) && $_FILES['doc_file']['name'] != "") {
        $file_ext = strtolower(pathinfo($_FILES['doc_file']['name'], PATHINFO_EXTENSION));
        $temp_file = $_FILES['doc_file']['tmp_name'];
        
        // 1. Parse .DOCX
        if($file_ext == 'docx') {
            $imported_content = read_docx($temp_file);
            $imported_title = pathinfo($_FILES['doc_file']['name'], PATHINFO_FILENAME);
        } 
        // 2. Parse .TXT
        elseif($file_ext == 'txt') {
            $imported_content = file_get_contents($temp_file);
            $imported_title = pathinfo($_FILES['doc_file']['name'], PATHINFO_FILENAME);
        } 
        else {
            $error = "Error: Please upload a valid Word (.docx) or Text (.txt) file.";
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
        height: 500,
        menubar: false,
        plugins: 'link image code lists',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter | bullist numlist | link',
        content_style: 'body { font-family:Inter,sans-serif; font-size:16px; color:#334155; line-height:1.6; }'
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
                    <h3>Auto-Generate from File</h3>
                    <p>Upload a Word Doc (.docx) or Text file to instantly fill the editor.</p>
                </div>
            </div>
            
            <form method="POST" enctype="multipart/form-data" class="import-form">
                <div class="file-drop-zone">
                    <input type="file" name="doc_file" id="doc_file" accept=".docx, .txt" required onchange="this.form.submit()">
                    <span class="drop-text"><i class="fa-solid fa-cloud-arrow-up"></i> Click to Upload File</span>
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
                           placeholder="Enter an engaging title..." 
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
                            <label for="file-input">
                                <i class="fa-solid fa-image"></i> Choose Image
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Content Body</label>
                    <textarea id="content-editor" name="content"><?php echo htmlspecialchars($imported_content); ?></textarea>
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