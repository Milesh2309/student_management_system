document.addEventListener('DOMContentLoaded', function () {
    const studentForm = document.getElementById('student-form');
    const studentTableBody = document.getElementById('student-table-body');
    const formTitle = document.getElementById('form-title');
    const submitBtn = document.getElementById('submit-btn');
    const cancelBtn = document.getElementById('cancel-btn');
    const studentIdInput = document.getElementById('student-id');
    const addStudentBtn = document.getElementById('add-student-btn');
    const studentFormContainer = document.getElementById('student-form-container');
    const studentListContainer = document.getElementById('student-list-container');

    // Show add student form
    addStudentBtn.addEventListener('click', () => {
        resetForm();
        studentFormContainer.style.display = 'block';
        studentListContainer.style.display = 'none';
    });

    // Load students and render
    function loadStudents() {
        fetch('list_students.php')
            .then(response => response.json())
            .then(data => {
                studentTableBody.innerHTML = '';
                data.forEach(student => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${student.id}</td>
                        <td>${student.name}</td>
                        <td>${student.email}</td>
                        <td>${student.phone}</td>
                        <td>${student.course}</td>
                        <td>
                            <button class="action-btn edit-btn" data-id="${student.id}">Edit</button>
                            <button class="action-btn delete-btn" data-id="${student.id}">Delete</button>
                        </td>
                    `;
                    studentTableBody.appendChild(tr);
                });
                attachEventListeners();
            })
            .catch(error => {
                alert('Failed to load students.');
                console.error('Error:', error);
            });
    }

    // Attach event listeners to edit and delete buttons
    function attachEventListeners() {
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                editStudent(id);
            });
        });

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this student?')) {
                    deleteStudent(id);
                }
            });
        });
    }

    // Edit student - fetch data and populate form
    function editStudent(id) {
        fetch(`list_students.php?id=${id}`)
            .then(response => response.json())
            .then(student => {
                if (student) {
                    studentIdInput.value = student.id;
                    studentForm.name.value = student.name;
                    studentForm.email.value = student.email;
                    studentForm.phone.value = student.phone;
                    studentForm.course.value = student.course;
                    formTitle.textContent = 'Edit Student';
                    submitBtn.textContent = 'Update Student';
                    cancelBtn.style.display = 'inline-block';
                    studentFormContainer.style.display = 'block';
                    studentListContainer.style.display = 'none';
                } else {
                    alert('Student not found.');
                }
            })
            .catch(error => {
                alert('Failed to fetch student data.');
                console.error('Error:', error);
            });
    }

    // Delete student
    function deleteStudent(id) {
        fetch('delete_student.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `id=${encodeURIComponent(id)}`
        })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    loadStudents();
                } else {
                    alert('Failed to delete student.');
                }
            })
            .catch(error => {
                alert('Error deleting student.');
                console.error('Error:', error);
            });
    }

    // Reset form to add mode
    function resetForm() {
        studentIdInput.value = '';
        studentForm.reset();
        formTitle.textContent = 'Add Student';
        submitBtn.textContent = 'Add Student';
        cancelBtn.style.display = 'none';
    }

    // Handle form submit for add or edit
    studentForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const id = studentIdInput.value;
        const url = id ? 'edit_student.php' : 'add_student.php';

        const formData = new FormData(studentForm);
        if (id) {
            formData.append('id', id);
        }

        fetch(url, {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    loadStudents();
                    resetForm();
                    studentFormContainer.style.display = 'none';
                    studentListContainer.style.display = 'block';
                } else {
                    alert(result.message || 'Operation failed.');
                }
            })
            .catch(error => {
                alert('Error submitting form.');
                console.error('Error:', error);
            });
    });

    // Cancel edit
    cancelBtn.addEventListener('click', function () {
        resetForm();
        studentFormContainer.style.display = 'none';
        studentListContainer.style.display = 'block';
    });

    // Initial load
    loadStudents();
});
