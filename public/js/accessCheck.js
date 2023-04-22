const userType = document.querySelector('#user_type');
const accessCodeLayer = document.querySelector('#accessCodeLayer');

userType.addEventListener('change', () => {
    if (userType.value === 'student') {
        accessCodeLayer.classList.add('d-none');
    } else {
        accessCodeLayer.classList.remove('d-none');
    }
});
