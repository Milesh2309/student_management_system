<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Student Management System</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="container">
        <h1>Student Management System</h1>
        <div id="student-list-container">
            <h2>Student List</h2>
            <table id="student-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Course</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="student-table-body">
                    <!-- Student rows will be inserted here -->
                </tbody>
            </table>
            <button id="add-student-btn">Add Student</button>
        </div>

        <div id="student-form-container" style="display:none;">
            <h2 id="form-title">Add Student</h2>
            <form id="student-form">
                <input type="hidden" id="student-id" name="id" />
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required />
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required />
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" required />
                </div>
                <div class="form-group">
                    <label for="course">Course:</label>
                    <input type="text" id="course" name="course" required />
                </div>
                <button type="submit" id="submit-btn">Add Student</button>
                <button type="button" id="cancel-btn">Cancel</button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
