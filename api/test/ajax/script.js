console.log('Script');


// Testing GET Request: Get all users
// Creating XMLHttpRequest Obj
/*
const xhr = new XMLHttpRequest();

// Opening the request
xhr.open('GET', 'http://localhost/CollegeProject/AutomotivePartsDistributor/api/get/get-all-users.php', true);

// Specifying actions
xhr.onload = function(){
    if(this.status == 200){
        const users = JSON.parse(this.responseText);
        let html = `<table><tr>
                        <td>Id</td>
                        <td>Username</td>
                        <td>Password</td>
                        <td>Email</td>
                        <td>Mobile</td>
                    </tr>`;
        users.forEach(user => {
            html += `<tr>
                        <td>${user.id}</td>
                        <td>${user.username}</td>
                        <td>${user.password}</td>
                        <td>${user.email}</td>
                        <td>${user.mobile}</td>
                    </tr>`;
        });
        html += '</table>';
        document.getElementById('response').innerHTML = html;
    }
}

// xhr.send();
*/

// Testing post request: Get specific user
const xhr = new XMLHttpRequest();

// const params = '';
// xhr.open( 'POST', 'http://localhost/CollegeProject/AutomotivePartsDistributor/api/post/get-all-users.php', true);
const id = 5;
const params = 'id=' + id;
xhr.open( 'POST', 'http://localhost/CollegeProject/AutomotivePartsDistributor/api/post/get-user.php', true);
xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

xhr.onload = function(){
    if(this.status == 200){
        const users = JSON.parse(this.responseText);
        console.log(users)
        let html = `<table><tr>
                        <td>Id</td>
                        <td>Username</td>
                        <td>Password</td>
                        <td>Email</td>
                        <td>Mobile</td>
                    </tr>`;
        users.forEach(user => {
            html += `<tr>
                        <td>${user.id}</td>
                        <td>${user.username}</td>
                        <td>${user.password}</td>
                        <td>${user.email}</td>
                        <td>${user.mobile}</td>
                    </tr>`;
        });
        html += '</table>';
        document.getElementById('response').innerHTML = html;
    }
}

xhr.send(params);
