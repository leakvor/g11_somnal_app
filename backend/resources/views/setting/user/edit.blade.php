<x-app-layout>
  <div>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
      <div class="container mx-auto px-6 py-1 pb-16">
        <div class="bg-white shadow-md rounded my-6 p-5">
          <form id="userForm" method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('put')
            <div class="flex flex-col space-y-2">
              <label for="name" class="text-gray-700 select-none font-medium">User Name</label>
              <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter name"
                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                required pattern="^[A-Z][a-zA-Z\s]{0,254}$"
                title="User Name must start with a capital letter and contain only letters">
              <small id="nameError" class="text-red-600 hidden">User Name must start with a capital letter and contain
                only letters</small>
            </div>

            <div class="flex flex-col space-y-2 mt-3">
              <label for="email" class="text-gray-700 select-none font-medium">Email</label>
              <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}"
                placeholder="Enter email"
                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                required pattern="[^\s@]+@[^\s@]+\.[^\s@]+" title="A valid email address is required">
              <small id="emailError" class="text-red-600 hidden">A valid email address is required</small>
            </div>

            <div class="flex flex-col space-y-2 mt-3">
              <label for="phone" class="text-gray-700 select-none font-medium">Phone</label>
              <input id="phone" type="tel" name="phone" value="{{ old('phone', $user->phone) }}"
                placeholder="Enter phone"
                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                required pattern="^0[0-9]{2} [0-9]{3} [0-9]{3,4}$"
                title="Please enter a valid phone number starting with 0 and formatted as 0xx xxx xxx">
              <small id="phoneError" class="text-red-600 hidden">Please enter a valid phone number starting with 0 and
                formatted as 0xx xxx xxx</small>
            </div>

            <div class="flex flex-col space-y-2 mt-3">
              <label for="password" class="text-gray-700 select-none font-medium">Password</label>
              <input id="password" type="password" name="password" placeholder="Enter password"
                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                minlength="8">
              <small id="passwordError" class="text-red-600 hidden">Password must be at least 8 characters long</small>
            </div>

            <div class="flex flex-col space-y-2 mt-3">
              <label for="password_confirmation" class="text-gray-700 select-none font-medium">Confirm Password</label>
              <input id="password_confirmation" type="password" name="password_confirmation"
                placeholder="Re-enter password"
                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                minlength="8">
              <small id="passwordConfirmationError" class="text-red-600 hidden">Passwords do not match</small>
            </div>

            <div class="mt-3">
              <label for="togglePassword" class="text-gray-700 cursor-pointer">
                <input type="checkbox" id="togglePassword" class="mr-2">
                Show Password
              </label>
            </div>

            <h3 class="text-xl my-4 text-gray-600">Role</h3>
            <div class="grid grid-cols-3 gap-4">
              @foreach($roles as $role)
          <div class="flex flex-col justify-center">
          <div class="flex flex-col">
            <label class="inline-flex items-center mt-3">
            <input type="radio" class="form-radio h-5 w-5 text-blue-600" name="roles[]" value="{{ $role->id }}"
              {{ count($user->roles->where('id', $role->id)) ? 'checked' : '' }}>
            <span class="ml-2 text-gray-700">{{ $role->name }}</span>
            </label>
          </div>
          </div>
        @endforeach
            </div>
            <div class="text-center mt-16 mb-16">
              <button type="submit"
                class="bg-green-700 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-green-600 transition-colors">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>
</x-app-layout>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('userForm');

    // Function to toggle password visibility
    const togglePasswordVisibility = () => {
      const passwordInput = document.getElementById('password');
      const confirmPasswordInput = document.getElementById('password_confirmation');
      const togglePasswordCheckbox = document.getElementById('togglePassword');

      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      confirmPasswordInput.setAttribute('type', type);
      togglePasswordCheckbox.checked = type === 'text';
    };

    // Toggle password visibility when checkbox is changed
    const togglePasswordCheckbox = document.getElementById('togglePassword');
    togglePasswordCheckbox.addEventListener('change', () => {
      togglePasswordVisibility();
    });

    // Add event listeners for input fields
    const nameInput = document.getElementById('name');
    nameInput.addEventListener('input', function () {
      validateName(nameInput);
    });

    const emailInput = document.getElementById('email');
    emailInput.addEventListener('input', function () {
      validateEmail(emailInput);
    });

    const phoneInput = document.getElementById('phone');
    phoneInput.addEventListener('input', function () {
      validatePhone(phoneInput);
    });

    const passwordInput = document.getElementById('password');
    passwordInput.addEventListener('input', function () {
      if (passwordInput.value.trim() !== '') {
        validatePassword(passwordInput);
      } else {
        hideError('passwordError');
      }
    });

    const confirmPasswordInput = document.getElementById('password_confirmation');
    confirmPasswordInput.addEventListener('input', function () {
      if (confirmPasswordInput.value.trim() !== '') {
        validateConfirmPassword(confirmPasswordInput, passwordInput);
      } else {
        hideError('passwordConfirmationError');
      }
    });

    form.addEventListener('submit', function (event) {
      event.preventDefault();

      // Validate all fields before submitting
      const isNameValid = validateName(nameInput);
      const isEmailValid = validateEmail(emailInput);
      const isPhoneValid = validatePhone(phoneInput);
      let isPasswordValid = true;
      let isConfirmPasswordValid = true;

      // Validate password fields if they are not empty
      if (passwordInput.value.trim() !== '') {
        isPasswordValid = validatePassword(passwordInput);
        isConfirmPasswordValid = validateConfirmPassword(confirmPasswordInput, passwordInput);
      }

      // Submit the form if all inputs are valid
      if (isNameValid && isEmailValid && isPhoneValid && isPasswordValid && isConfirmPasswordValid) {
        form.submit();
      }
    });

    // Validation functions
    function validateName(nameInput) {
      const nameError = document.getElementById('nameError');
      const namePattern = /^[A-Z][a-zA-Z\s]{0,254}$/;

      if (!namePattern.test(nameInput.value)) {
        showError(nameError);
        return false;
      } else {
        hideError('nameError');
        return true;
      }
    }

    function validateEmail(emailInput) {
      const emailError = document.getElementById('emailError');
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (!emailPattern.test(emailInput.value)) {
        showError(emailError);
        return false;
      } else {
        hideError('emailError');
        return true;
      }
    }

    function validatePhone(phoneInput) {
      const phoneError = document.getElementById('phoneError');
      const phonePattern = /^0[0-9]{2} [0-9]{3} [0-9]{4}$/;

      let cleanedValue = phoneInput.value.replace(/\D/g, '');

      // Ensure the phone number starts with zero
      if (cleanedValue.charAt(0) !== '0') {
        cleanedValue = '0' + cleanedValue;
      }

      cleanedValue = cleanedValue.slice(0, 10);

      if (cleanedValue.length >= 4) {
        cleanedValue = cleanedValue.slice(0, 3) + ' ' + cleanedValue.slice(3);
      }
      if (cleanedValue.length >= 8) {
        cleanedValue = cleanedValue.slice(0, 7) + ' ' + cleanedValue.slice(7);
      }

      phoneInput.value = cleanedValue.trim();

      if (!phonePattern.test(cleanedValue)) {
        showError(phoneError);
        return false;
      } else {
        hideError('phoneError');
        return true;
      }
    }


    function validatePassword(passwordInput) {
      const passwordError = document.getElementById('passwordError');
      if (passwordInput.value.length < 8) {
        showError(passwordError);
        return false;
      } else {
        hideError('passwordError');
        return true;
      }
    }

    function validateConfirmPassword(confirmPasswordInput, passwordInput) {
      const passwordConfirmationError = document.getElementById('passwordConfirmationError');
      if (confirmPasswordInput.value !== passwordInput.value) {
        showError(passwordConfirmationError);
        return false;
      } else {
        hideError('passwordConfirmationError');
        return true;
      }
    }

    function showError(errorElement) {
      errorElement.classList.remove('hidden');
    }

    function hideError(errorId) {
      const errorElement = document.getElementById(errorId);
      errorElement.classList.add('hidden');
    }
  });

</script>