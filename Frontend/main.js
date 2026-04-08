// Загрузка всех студентов

async function getStudents() {
    let res = await fetch('http://restfullapiproject/Backend/students');
    let students = await res.json();
    
    let container = document.querySelector('.card-body');
    container.innerHTML = '';
    
    students.forEach(student => {
        container.innerHTML += 
        `
            <div class="border-bottom mb-2 pb-2">
                <h5>${student.name} ${student.surname}</h5>
                <p>Группа: ${student.groups}<br>Email: ${student.email}</p>
                <button onclick="deleteStudent(${student.id})" class="btn btn-primary">Удалить студента</button> 
                <br><br><button onclick="selectStudent('${student.id}', '${student.name}', '${student.surname}', '${student.groups}', '${student.email}')" class="btn btn-primary">Редактировать</button>
            </div>
        `;
    });
}

//Добавление студента

async function addStudents(event) {
    event.preventDefault();

    const Data = new FormData();

    Data.append('name', document.getElementById('name').value);
    Data.append('surname', document.getElementById('surname').value);
    Data.append('groups', document.getElementById('groups').value);
    Data.append('email', document.getElementById('email').value);

    await fetch('http://restfullapiproject/Backend/students', {
        method: 'POST',
        body: Data
    });

    document.getElementById('studentForm').reset();
    await getStudents();
}

async function deleteStudent(id){ 
    await fetch(`http://restfullapiproject/Backend/students/${id}`, {
        method: 'DELETE'    
    });
    await getStudents();
}

let ida = null;
async function selectStudent(idP, name, surname, groups, email) {
    ida = idP;
    document.getElementById('name-edit').value = name;
    document.getElementById('surname-edit').value = surname;
    document.getElementById('groups-edit').value = groups;
    document.getElementById('email-edit').value = email;
}

async function updateStudent(event) {
    event.preventDefault();
    
    const data = {
        name: document.getElementById('name-edit').value,
        surname: document.getElementById('surname-edit').value,
        groups: document.getElementById('groups-edit').value,
        email: document.getElementById('email-edit').value
    };

    const response = await fetch(`http://restfullapiproject/Backend/students/${ida}`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });

    const result = await response.json();
    console.log('Update result:', result);

    document.getElementById('name-edit').value = '';
    document.getElementById('surname-edit').value = '';
    document.getElementById('groups-edit').value = '';
    document.getElementById('email-edit').value = '';
    ida = null;
    
    await getStudents();
}

document.getElementById('studentForm').onsubmit = addStudents;
document.getElementById('editStudentForm').onsubmit = updateStudent;
getStudents();

//http://api/students/
