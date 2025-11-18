

        // Set current date
        document.getElementById('currentDate').textContent = new Date().toLocaleDateString('en-US', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'

        });

    

        document.getElementById('studentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Reset error messages
            document.querySelectorAll('.error').forEach(el => el.textContent = '');
            document.getElementById('successMessage').style.display = 'none';
            document.getElementById('errorMessage').style.display = 'none';
            
            // Get form values
            const fullName = document.getElementById('fullName').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const course = document.getElementById('course').value.trim();
            const dob = document.getElementById('dob').value;
            const address = document.getElementById('address').value.trim();
            
            // Validate form
            let isValid = true;
            
            if (fullName === '') {
                document.getElementById('nameError').textContent = 'Full name is required';
                isValid = false;
            }
            
            if (email === '') {
                document.getElementById('emailError').textContent = 'Email is required';
                isValid = false;
            } else if (!isValidEmail(email)) {
                document.getElementById('emailError').textContent = 'Please enter a valid email address';
                isValid = false;
            }
            
            if (phone === '') {
                document.getElementById('phoneError').textContent = 'Phone number is required';
                isValid = false;
            }
            
            if (course === '') {
                document.getElementById('courseError').textContent = 'Course is required';
                isValid = false;
            }
            
            if (dob === '') {
                document.getElementById('dobError').textContent = 'Date of birth is required';
                isValid = false;
            }
            
            if (address === '') {
                document.getElementById('addressError').textContent = 'Address is required';
                isValid = false;
            }
            
            if (isValid) {
                // Submit the form via AJAX
                submitForm({
                    fullName,
                    email,
                    phone,
                    course,
                    dob,
                    address
                });
            }
        });
        
        function isValidEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
        
        function submitForm(formData) {
            // Create a FormData object
            const data = new FormData();
            for (const key in formData) {
                data.append(key, formData[key]);
            }
            
            // Send the data to the server using fetch API
            fetch('', {
                method: 'POST',
                body: data
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    showSuccess(result.message);
                    document.getElementById('studentForm').reset();
                } else {
                    showError(result.message);
                }
            })
            .catch(error => {
                showError('An error occurred while submitting the form.');
            });
        }
        
        function showSuccess(message) {
            const successElement = document.getElementById('successMessage');
            successElement.textContent = message;
            successElement.style.display = 'block';
        }
        
        function showError(message) {
            const errorElement = document.getElementById('errorMessage');
            errorElement.textContent = message;
            errorElement.style.display = 'block';
        }

        // Login button functionality
        document.getElementById('loginButton').addEventListener('click', function() {
        document.getElementById('homeContent').style.display = 'none';
            document.getElementById('loginContent').style.display = 'block';
            document.getElementById('loginButton').style.backgroundColor = 'lightgreen';
            document.getElementById('academicStatusContent').style.display = 'none';
        });

function register(){
    
            document.getElementById('homeContent').style.display = 'none';
            document.getElementById('registerContent').style.display = 'block';
            document.getElementById('registerButton').style.backgroundColor = 'lightgreen';
            document.getElementById('academicStatusContent').style.display = 'none';
     
}

        // Login link functionality
        document.getElementById('loginLink').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('homeContent').style.display = 'none';
            document.getElementById('loginContent').style.display = 'block';
            document.getElementById('academicStatusContent').style.display = 'none';
        });
        // Cancel login functionality
        document.getElementById('cancelLogin').addEventListener('click', function() {
            document.getElementById('homeContent').style.display = 'block';
            document.getElementById('loginContent').style.display = 'none';
            document.getElementById('academicStatusContent').style.display = 'none';
        });
        // Reset password functionality
        document.getElementById('resetPassword').addEventListener('click', function() {
            alert('Password reset functionality would be implemented here.');
        });
        // Login form submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Simulate successful login
            document.getElementById('loginForm').style.backgroundColor= 'lightgreen';
            document.getElementById('homeContent').style.display = 'none';
            document.getElementById('loginContent').style.display = 'none';
            document.getElementById('academicStatusContent').style.display = 'block';
        });


   function TimeForm(){
     let times=new Date();
      let hours=times.getHours();
      let Mins=times.getMinutes();
      let sec=times.getSeconds();
     let AllltimeCount=`${hours}:${mins}:${sec}`;
      let TimeCount=document.getElementById("TimeForm").innerText=times;;

        } setInterval(TimeForm,1000);

