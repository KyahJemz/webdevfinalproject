export default class Alert {
    static SendAlert(type, msg, time) {
        const alertContainer = document.querySelector('.alert-container'); 

        if (type === "danger" || type === "warning" || type === "success") {
            const alertBox = document.createElement('div');
            alertBox.classList.add('alert-box', type); 
            const alertText = document.createElement('p');
            alertText.classList.add('alert-text');
            alertText.textContent = msg;
            alertBox.appendChild(alertText);
            alertContainer.appendChild(alertBox);
            this.showAlert(alertBox, time); 
        } else {
           
        }
    }

    static showAlert(child, time) {
        child.classList.add('in');
        setTimeout(() => {
            this.hideAlert(child); 
        }, time);
    }

    static hideAlert(child) { 
        child.classList.remove('in');
        child.classList.add('out');
        setTimeout(() => {
            child.remove(); 
        }, 1000); 
    }
}
