<?php
ob_start();
session_start();
// if(!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }

include '../includes/db_connect.php';

// --- SMART CONTENT PARSER ---
$imported_content = "";
$imported_title = "";

// 1. Helper: Format raw text
function format_as_blog_post($raw_text) {
    $lines = preg_split('/\r\n|\r|\n/', $raw_text);
    $html_output = "";
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line)) continue;
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
    $objects = array();
    if (preg_match_all('/<<.*?>>/s', $content, $objects)) {
        foreach ($objects[0] as $object) {
            if (strpos($object, '/FlateDecode') !== false) {
                $stream_start = strpos($content, 'stream', strpos($content, $object)) + 6;
                $stream_end = strpos($content, 'endstream', $stream_start);
                $stream = substr($content, $stream_start, $stream_end - $stream_start);
                $decoded = @gzuncompress(trim($stream));
                if ($decoded) {
                    if(preg_match_all('/\((.*?)\) ?Tj/', $decoded, $matches)) {
                        foreach($matches[1] as $match) { $text .= $match . " "; }
                        $text .= "\n"; 
                    }
                }
            }
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

        if($file_ext == 'docx') { $raw_text = read_docx($temp_file); } 
        elseif($file_ext == 'txt') { $raw_text = file_get_contents($temp_file); }
        elseif($file_ext == 'pdf') { $raw_text = read_pdf($temp_file); } 
        else { $error = "File type not supported. Use .docx, .pdf, or .txt"; }

        if(!empty($raw_text)) {
            $imported_content = format_as_blog_post($raw_text);
            $imported_title = ucwords(str_replace(['_', '-'], ' ', $imported_title));
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
        $image = time() . "_" . $_FILES['image']['name'];
        $target = "../uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    $sql = "INSERT INTO posts (title, category, image, content) VALUES ('$title', '$category', '$image', '$content')";
    
    if(mysqli_query($conn, $sql)) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Database Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        plugins: 'link image code lists table wordcount',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter | bullist numlist | link table',
        content_style: 'body { font-family:Inter,sans-serif; font-size:16px; color:#334155; line-height:1.8; padding: 20px; }'
      });
    </script>

    <style>
        :root {
            --primary: #0f172a;
            --accent: #f59e0b;
            --bg: #f1f5f9;
            --text: #334155;
        }
        
        * { box-sizing: border-box; }
        body { background-color: var(--bg); font-family: 'Inter', sans-serif; margin: 0; padding: 0; color: var(--text); }
        a { text-decoration: none; }

        /* --- NAVBAR (Copied from Dashboard) --- */
        .admin-navbar { background: white; border-bottom: 1px solid #e2e8f0; position: sticky; top: 0; z-index: 100; }
        .nav-container { 
            max-width: 1200px; margin: 0 auto; padding: 0 20px; height: 70px; 
            display: flex; align-items: center; justify-content: space-between; 
            position: relative;
        }
        .nav-brand { font-weight: 800; font-size: 1.2rem; color: var(--primary); display: flex; align-items: center; gap: 8px; }
        .nav-brand span { color: var(--accent); }
        
        .nav-menu-wrapper { display: flex; align-items: center; gap: 30px; } 

        .nav-links { display: flex; gap: 20px; }
        .nav-links a { color: #64748b; font-weight: 500; font-size: 0.95rem; transition: 0.2s; display: flex; align-items: center; gap: 6px; }
        .nav-links a:hover, .nav-links a.active { color: var(--primary); }
        
        .nav-user { display: flex; align-items: center; gap: 15px; }
        .admin-badge { background: #e0f2fe; color: #0284c7; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }
        .btn-logout { color: #ef4444; font-weight: 600; font-size: 0.9rem; }

        .mobile-toggle { display: none; background: none; border: none; font-size: 1.5rem; color: var(--primary); cursor: pointer; }

        /* --- PAGE CONTENT --- */
        .main-container { max-width: 900px; margin: 40px auto; padding: 0 20px; }

        /* Import Card */
        .import-card {
            background: #e0f2fe; border: 1px dashed #3b82f6; border-radius: 12px; padding: 20px;
            display: flex; align-items: center; justify-content: space-between; margin-bottom: 30px;
            flex-wrap: wrap; gap: 20px;
        }
        .import-info { display: flex; align-items: center; gap: 15px; }
        .icon-circle { 
            width: 50px; height: 50px; background: white; border-radius: 50%; color: #3b82f6; 
            display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;
        }
        .file-upload-btn {
            position: relative; overflow: hidden; display: inline-block; cursor: pointer;
            background: white; color: #3b82f6; padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 0.9rem;
            transition: 0.2s; box-shadow: 0 2px 5px rgba(0,0,0,0.05); white-space: nowrap;
        }
        .file-upload-btn:hover { background: #f1f5f9; }
        .file-upload-btn input[type=file] { position: absolute; left: 0; top: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }

        /* Editor Card */
        .editor-container {
            background: white; padding: 40px; border-radius: 16px; border: 1px solid #e2e8f0; 
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
        }
        
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
        
        .form-label { display: block; font-weight: 600; margin-bottom: 8px; color: #374151; font-size: 0.95rem; }
        .form-control, .form-select {
            width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 1rem;
            margin-bottom: 20px; transition: border-color 0.2s; font-family: inherit;
        }
        .form-control:focus, .form-select:focus { outline: none; border-color: #f59e0b; box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1); }

        .btn-publish {
            background-color: #0f172a; color: white; padding: 14px 28px; border-radius: 8px; 
            font-weight: 600; border: none; cursor: pointer; font-size: 1rem; width: 100%;
            display: flex; align-items: center; justify-content: center; gap: 10px; transition: 0.2s;
        }
        .btn-publish:hover { background-color: #1e293b; }

        .action-row { display: flex; gap: 15px; margin-top: 30px; }
        .btn-discard { padding: 14px 28px; color: #64748b; font-weight: 600; text-decoration: none; border-radius: 8px; display: inline-block; text-align: center; }
        .btn-discard:hover { background: #f1f5f9; color: #334155; }

        /* --- MOBILE MEDIA QUERIES --- */
        @media (max-width: 992px) {
            .mobile-toggle { display: block; }
            
            .nav-menu-wrapper {
                position: absolute; top: 70px; left: 0; width: 100%; background: white;
                flex-direction: column; align-items: flex-start; padding: 0; border-bottom: 1px solid #e2e8f0;
                max-height: 0; overflow: hidden; transition: max-height 0.3s ease-in-out; gap: 0;
                box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            }
            .nav-menu-wrapper.active { max-height: 400px; }

            .nav-links { flex-direction: column; width: 100%; gap: 0; }
            .nav-links a { padding: 15px 25px; width: 100%; border-bottom: 1px solid #f8fafc; }
            .nav-user { padding: 15px 25px; width: 100%; justify-content: space-between; background: #f8fafc; }
            
            /* Form Adjustments */
            .editor-container { padding: 25px; }
            .form-row { grid-template-columns: 1fr; gap: 0; }
            
            .import-card { flex-direction: column; text-align: center; }
            .import-info { flex-direction: column; }
            .file-upload-btn { width: 100%; text-align: center; }
            
            .action-row { flex-direction: column-reverse; }
            .btn-discard { width: 100%; }
        }
    </style>
</head>
<body>

    <nav class="admin-navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <img src="../assets/img/logo.png" alt="" width="50px"></i> SoW!SE <span>Admin</span>
            </div>

            <button class="mobile-toggle" onclick="toggleMenu()">
                <i class="fa-solid fa-bars"></i>
            </button>

            <div class="nav-menu-wrapper" id="navMenu">
                <div class="nav-links">
                    <a href="dashboard.php" ><i class="fa-solid fa-layer-group"></i> Dashboard</a>
                    <a href="add_post.php" class="active"><i class="fa-solid fa-pen-to-square"></i> Write New</a>
                    <a href="manage_team.php"><i class="fa-solid fa-users"></i> Team</a>
                    <a href="../index.php" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square"></i> View Site</a>
                </div>

                <div class="nav-user">
                    <span class="admin-badge">Admin Logged In</span>
                    <a href="../logout.php" class="btn-logout"><i class="fa-solid fa-power-off"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <div class="main-container">

        <div class="import-card">
            <div class="import-info">
                <div class="icon-circle"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
                <div>
                    <h4 style="margin:0; color:#1e3a8a;">Smart Import</h4>
                    <small style="color:#60a5fa;">Upload a .docx or .pdf to auto-fill content.</small>
                </div>
            </div>
            <form method="POST" enctype="multipart/form-data" id="importForm" style="width: 100%; max-width: 200px;">
                <label class="file-upload-btn">
                    <input type="file" name="doc_file" accept=".docx, .pdf, .txt" onchange="document.getElementById('importForm').submit()">
                    <i class="fa-solid fa-cloud-arrow-up"></i> Upload File
                </label>
                <input type="hidden" name="import_doc" value="1">
            </form>
        </div>

        <?php if(isset($error)) echo "<div style='background:#fee2e2; color:#b91c1c; padding:15px; border-radius:8px; margin-bottom:20px;'>$error</div>"; ?>

        <div class="editor-container">
            <div class="card-header" style="border-bottom: 1px solid #f1f5f9; padding-bottom: 20px; margin-bottom: 30px;">
                <h2 style="margin:0; font-size:1.5rem; color:#0f172a;">Compose Article</h2>
            </div>

            <form method="POST" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label class="form-label">Article Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter a catchy headline..." value="<?php echo htmlspecialchars($imported_title); ?>" required>
                </div>

                <div class="form-row">
                    <div>
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select">
                            <option value="News & Updates">News & Updates</option>
                            <option value="Success Story">Success Story</option>
                            <option value="Event">Event / Workshop</option>
                            <option value="Announcement">Announcement</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Featured Image</label>
                        <input type="file" name="image" class="form-control" style="padding: 9px;">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Content Body</label>
                    <textarea id="content-editor" name="content"><?php echo $imported_content; ?></textarea>
                </div>

                <div class="action-row">
                    <a href="dashboard.php" class="btn-discard">Discard</a>
                    <button type="submit" name="submit" class="btn-publish">
                        <i class="fa-solid fa-paper-plane"></i> Publish Now
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('navMenu');
            menu.classList.toggle('active');
        }
    </script>

</body>
</html>