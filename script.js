import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-analytics.js";
import { getAuth, signInWithEmailAndPassword, createUserWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-auth.js";

	// Your web app's Firebase configuration
	// For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyBHOBiywCHehFLC_a385_5A9jfGtqFRw-g",
    authDomain: "login-ba6a9.firebaseapp.com",
    projectId: "login-ba6a9",
    storageBucket: "login-ba6a9.appspot.com",
    messagingSenderId: "848846509665",
    appId: "1:848846509665:web:7c62b84d057ee8cc9a3c20",
    measurementId: "G-CXRC2JD0MS"
  };


const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
const auth = getAuth(app);

const submitButton = document.getElementById("submit");
const signupButton = document.getElementById("sign-up");
const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");
const main = document.getElementById("main");
const createacct = document.getElementById("create-acct")

const signupEmailIn = document.getElementById("email-signup");
const confirmSignupEmailIn = document.getElementById("confirm-email-signup");
const signupPasswordIn = document.getElementById("password-signup");
const confirmSignUpPasswordIn = document.getElementById("confirm-password-signup");
const createacctbtn = document.getElementById("create-acct-btn");

const returnBtn = document.getElementById("return-btn");

var email, password, signupEmail, signupPassword, confirmSignupEmail, confirmSignUpPassword;

createacctbtn.addEventListener("click", function() {
  var isVerified = true;

  signupEmail = signupEmailIn.value;
  confirmSignupEmail = confirmSignupEmailIn.value;
  if(signupEmail != confirmSignupEmail) {
      window.alert("Email fields do not match. Try again.")
      isVerified = false;
  }

  signupPassword = signupPasswordIn.value;
  confirmSignUpPassword = confirmSignUpPasswordIn.value;
  if(signupPassword != confirmSignUpPassword) {
      window.alert("Password fields do not match. Try again.")
      isVerified = false;
  }
  
  if(signupEmail == null || confirmSignupEmail == null || signupPassword == null || confirmSignUpPassword == null) {
    window.alert("Please fill out all required fields.");
    isVerified = false;
  }
  
  if(isVerified) {
    createUserWithEmailAndPassword(auth, signupEmail, signupPassword)
      .then((userCredential) => {
      // Signed in 
      const user = userCredential.user;
      // ...
      window.alert("Success! Account created.");
    })
    .catch((error) => {
      const errorCode = error.code;
      const errorMessage = error.message;
      // ..
      window.alert("Error occurred. Try again.");
    });
  }
});

submitButton.addEventListener("click", function() {
  email = emailInput.value;
  console.log(email);
  password = passwordInput.value;
  console.log(password);

  signInWithEmailAndPassword(auth, email, password)
    .then((userCredential) => {
      // Signed in
      const user = userCredential.user;
      console.log("Success! Welcome back!");

      setTimeout(() => {
        window.location.replace("index.html");
      }, 500);

      // ...
    })
    .catch((error) => {
      const errorCode = error.code;
      const errorMessage = error.message;
      console.log("Error occurred. Try again.");
      window.alert("Error occurred. Try again.");
    });
});

signupButton.addEventListener("click", function() {
    main.style.display = "none";
    createacct.style.display = "block";
});

returnBtn.addEventListener("click", function() {
    main.style.display = "block";
    createacct.style.display = "none";
});
