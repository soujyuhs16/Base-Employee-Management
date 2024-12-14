document.addEventListener('DOMContentLoaded', function() {
    loadEmployees();

    // 添加员工表单提交处理
    document.getElementById('addEmployeeForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const employeeData = {
            first_name: document.getElementById('firstName').value,
            last_name: document.getElementById('lastName').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            position: document.getElementById('position').value
        };

        fetch('api/create.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(employeeData)
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (!data.errors) {
                loadEmployees();
                document.getElementById('addEmployeeForm').reset();
            }
        })
        .catch(error => console.error('错误:', error));
    });
});

// 加载员工列表
function loadEmployees() {
    fetch('api/read.php')
        .then(response => response.json())
        .then(data => {
            const employeeList = document.getElementById('employeeList');
            employeeList.innerHTML = '';

            if (data.data) {
                data.data.forEach(employee => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${employee.id}</td>
                        <td>${employee.first_name} ${employee.last_name}</td>
                        <td>${employee.email}</td>
                        <td>${employee.position}</td>
                        <td>${employee.hire_date}</td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="deleteEmployee(${employee.id})">删除</button>
                        </td>
                    `;
                    employeeList.appendChild(row);
                });
            }
        })
        .catch(error => console.error('错误:', error));
}

// 删除员工
function deleteEmployee(id) {
    if (confirm('确定要删除这名员工吗？')) {
        fetch(`api/delete.php?id=${id}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            loadEmployees();
        })
        .catch(error => console.error('错误:', error));
    }
}