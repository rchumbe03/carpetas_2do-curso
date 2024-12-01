document.addEventListener('DOMContentLoaded', () => {
    // Elementos nombrados
    const form = document.getElementById('userForm');
    const storedDataDiv = document.getElementById('storedData');
    const deleteDatabutton = document.getElementById('deleteData');
    const changeThemeButton = document.getElementById('changeTheme');

    // Función para validar el email
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;

        if (name && validateEmail(email)) {
            document.cookie = `name=${name}; path=/`;
            document.cookie = `email=${email}; path=/`;
            localStorage.setItem('name', name);
            localStorage.setItem('email', email);
            displayStoredData();
        } else {
            alert('Por favor, complete todos los campos correctamente');
        }
    });

    // Funcion para borrar los datos
    deleteDatabutton.addEventListener('click', () => {
        document.cookie = 'name=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/';
        document.cookie = 'email=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/';
        localStorage.removeItem('name');
        localStorage.removeItem('email');
        displayStoredData();
    });

    // Funcion para cambiar el color del background
    changeThemeButton.addEventListener('click', () => {
        const body = document.body;
        const isDark = body.classList.toggle('dark-theme');
        body.style.backgroundColor = isDark ? '#333' : '#fff';
        body.style.color = isDark ? '#fff' : '#333';
    });

    // Validar Email
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    // Mostrar los datos almacenados
    function displayStoredData() {
        const name = localStorage.getItem('name') || '';
        const email = localStorage.getItem('email') || '';
        storedDataDiv.innerHTML = name && email ? `<p>Nombre: ${name}</p><p>Correo: ${email}</p>` : '<p>No hay datos</p>';
    }

    displayStoredData();
});
