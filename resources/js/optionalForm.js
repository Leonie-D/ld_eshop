const checks = document.querySelectorAll('.form-check-input');
const newAddressCheck = document.getElementById('new-address');
const optionalForm = document.querySelector('.new-address');
let visible = false;

if(!newAddressCheck) {
    optionalForm.style.display = "block";
} else {
    optionalForm.style.display = "none";
};

const changeAffichage = (ev) => {
    if(ev.target.value !== newAddressCheck.value) {
        visible = false;
    } else {
        visible = true;
    };
    
    optionalForm.style.display = visible ? "block" : "none";
};

for(let check of checks) {
    check.addEventListener('change', changeAffichage);
};
