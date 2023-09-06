const ContainerPanel = document.querySelector('.container-panel');
const ShowSignInFormButtonBox = document.getElementById('sign-in-form-button');
const ShowSignUpFormButtonBox = document.getElementById('sign-up-form-button');
const SignInForm = document.querySelector('.sign-in-container');
const SignUpForm = document.querySelector('.sign-up-container');
const ShowSignInFormButton = ShowSignInFormButtonBox.querySelector('button');
const ShowSignUpFormButton = ShowSignUpFormButtonBox.querySelector('button');

ShowSignInFormButton.addEventListener('click', function(event) {
    ChangePanel('sign-in');
});

ShowSignUpFormButton.addEventListener('click', function(event) {
    ChangePanel('sign-up');
});

function ChangePanel(panel) {
    console.log("Activated : " + panel);
    if (panel === 'sign-up') {
        ContainerPanel.classList.remove('move-left');
        ContainerPanel.classList.add('move-right');

        SignInForm.classList.add('sign-in-container-hidden');
        SignUpForm.classList.remove('sign-up-container-hidden');

        ShowSignUpFormButtonBox.style.visibility = 'hidden';
        ShowSignInFormButtonBox.style.visibility =  'visible';
    } else if (panel === 'sign-in') {
        ContainerPanel.classList.add('move-left');
        ContainerPanel.classList.remove('move-right');

        SignInForm.classList.remove('sign-in-container-hidden');
        SignUpForm.classList.add('sign-up-container-hidden');

        ShowSignUpFormButtonBox.style.visibility = 'visible';
        ShowSignInFormButtonBox.style.visibility =  'hidden';
    }
}