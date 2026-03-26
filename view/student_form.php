<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($student) ? 'Sửa' : 'Thêm' ?> Sinh viên</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg: #f8fafc;
            --card-bg: rgba(255, 255, 255, 0.8);
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --danger: #ef4444;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f0f4ff 0%, #f8fafc 100%);
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 40px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
        }

        h2 {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        input {
            width: 100%;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid var(--border);
            outline: none;
            transition: all 0.3s;
            font-size: 1rem;
        }

        input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .error-list {
            background: #fff1f2;
            color: var(--danger);
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
            list-style: none;
            font-size: 0.9rem;
        }

        .actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 1rem;
            border: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: white;
            color: var(--text-main);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background: var(--bg);
        }
    </style>
</head>
<body>
    <div class="card">
        <h2><?= isset($student) ? 'Chỉnh sửa Sinh viên' : 'Thêm Sinh viên Mới' ?></h2>

        <?php if (!empty($errors)): ?>
            <ul class="error-list">
                <?php foreach ($errors as $error): ?>
                    <li>• <?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="name">Họ và tên</label>
                <input type="text" id="name" name="name" 
                       value="<?= htmlspecialchars($_POST['name'] ?? $student['name'] ?? '') ?>" 
                       placeholder="VD: Nguyễn Văn A" autofocus>
            </div>

            <div class="form-group">
                <label for="major">Ngành học</label>
                <input type="text" id="major" name="major" 
                       value="<?= htmlspecialchars($_POST['major'] ?? $student['major'] ?? '') ?>" 
                       placeholder="VD: Công nghệ thông tin">
            </div>

            <div class="actions">
                <a href="index.php" class="btn btn-secondary">Hủy</a>
                <button type="submit" class="btn btn-primary">
                    <?= isset($student) ? 'Cập nhật' : 'Lưu thông tin' ?>
                </button>
            </div>
        </form>
    </div>
</body>
</html>
