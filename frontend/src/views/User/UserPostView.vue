<template>
  <div class="container mt-5">
    <form class="form p-4">
      <h3 class="text-center m-3">Post Here!!</h3>
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input
          type="text"
          class="form-control shared-style"
          id="title"
          name="title"
          aria-describedby="emailHelp"
        />
      </div>
      <div class="mb-3 dropdown">
        <label for="item-dropdown" class="form-label">Item selection</label>
        <button class="form-control shared-style dropdown-toggle" type="button" id="item-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
          Select items
        </button>
        <ul class="dropdown-menu" aria-labelledby="item-dropdown">
          <li>
            <div class="form-check dropdown-item">
              <input class="form-check-input" type="checkbox" value="Check me 1" id="Checkme1">
              <label class="form-check-label" for="Checkme1">Check me 1</label>
            </div>
          </li>
          <li>
            <div class="form-check dropdown-item">
              <input class="form-check-input" type="checkbox" value="Check me 2" id="Checkme2" checked>
              <label class="form-check-label" for="Checkme2">Check me 2</label>
            </div>
          </li>
          <li>
            <div class="form-check dropdown-item">
              <input class="form-check-input" type="checkbox" value="Check me 3" id="Checkme3">
              <label class="form-check-label" for="Checkme3">Check me 3</label>
            </div>
          </li>
        </ul>
      </div>
      <div class="mb-3">
        <label for="formFile" class="form-label">File image post</label>
        <input class="form-control shared-style" type="file" id="formFile" name="file">
      </div>
      <div class="mb-3">
        <label for="company-selection" class="form-label" >Company Selection</label>
        <select id="company-selection" name="company" class="form-select shared-style" aria-label="Default select example">
          <option selected>Company selection</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
      </div>
      <div class="submit d-grid gap-2">
        <button class="btn btn-success" type="submite">Submit</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  mounted() {
    new bootstrap.Dropdown(document.getElementById('dropdownMenuButton'));
  }
}
</script>

<style scoped>
.container {
  width: 100%;
}

form {
  width: 40vw;
  margin: auto;
  border-radius: 10px;
  border-top: 7px solid rgb(248, 98, 44);
  background:white;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.dropdown .form-control, .dropdown-menu{
  width: 100%;
}
.dropdown .form-control{
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.form-check-input{
  margin-left: 20px;
}

.form-label{
  margin-top: 5px;
}

.submit {
  margin-top: 7%;
  margin-bottom: 5%;
}
@media screen and (max-width: 1114px) {
  form {
    width: 90vw;
  }
  .mb-3 .btn, .mb-3 input, .mb-3 select, .submit .btn {
    height: 50px;
  }
 
  .dropdown .form-control, .mb-3 #formFile, .mb-3 .form-select, .submit .btn, .form-label,.form-check-label {
    font-size: 26px;
  }
  #company-selection option {
    font-size: 14px; 
  }
  .submit {
    margin-top: 10%;
  }
  /* Adjust checkbox size */
  input[type="checkbox"] {
    width: 50px;
    height:50px; 
  }

}
@media screen and (max-width: 1280px) {
  form {
    width: 80vw;
  }
  .mb-3 .btn, .mb-3 input, .mb-3 select, .submit .btn {
    height: 50px;
  }
 
  .dropdown .form-control, .mb-3 #formFile, .mb-3 .form-select, .submit .btn, .form-label,.form-check-label {
    font-size: 26px;
  }
  #company-selection option {
    font-size: 14px; 
  }
  .submit {
    margin-top: 6%;
  }
  /* Adjust checkbox size */
  input[type="checkbox"] {
    width: 30px;
    height: 30px; 
  }
  .form-check-label{
    font-size: 24px;
  }
  .form-select option{
    font-size: 16px;
  }
}
@media screen and (max-width: 884px) {
  form {
    width: 80vw;
  }
  .mb-3 .btn, .mb-3 input, .mb-3 select, .submit .btn {
    height: 50px;
    margin: 5px;
  }
  .form-label {
    font-size: 26px;
  }
  .dropdown .form-control, .mb-3 #formFile, .mb-3 .form-select, .submit .btn {
    font-size: 22px;
  }
  /* Adjust checkbox size */
  input[type="checkbox"] {
    width: 30px; /* Adjust width */
    height:30px; /* Adjust height */
  }
  .form-check-label{
    font-size: 24px;
  }
}
@media screen and (max-width: 834px) {
  form {
    width: 80vw;
  }
  .mb-3 .btn, .mb-3 input, .mb-3 select, .submit .btn {
    height: 50px;
  }
 
  .dropdown .form-control, .mb-3 #formFile, .mb-3 .form-select, .submit .btn, .form-label,.form-check-label {
    font-size: 26px;
  }
  #company-selection option {
    font-size: 12px; 
  }
  .submit {
    margin-top: 6%;
  }
  /* Adjust checkbox size */
  input[type="checkbox"] {
    width: 30px; 
    height:30px; 
  }
  .form-check-label{
    font-size: 24px;
  }
}

@media screen and (max-width: 820px) {
  form {
    width: 90vw;
  }
  .mb-3 .btn, .mb-3 input, .mb-3 select, .submit .btn {
    height: 50px;
  }
 
  .dropdown .form-control, .mb-3 #formFile, .mb-3 .form-select, .submit .btn, .form-label,.form-check-label {
    font-size: 26px;
  }
  #company-selection option {
    font-size: 12px; 
  }
  /* Adjust checkbox size */
  input[type="checkbox"] {
    width: 30px; 
    height:30px; 
  }
  .form-check-label{
    font-size: 24px;
  }
  
  .submit {
    margin-top: 6%;
  }
}
@media screen and (max-width: 800px) {
  form {
    width: 90vw;
  }
  .mb-3 .btn, .mb-3 input, .mb-3 select, .submit .btn {
    height: 50px;
    margin: 5px;
  }
  .mb-3 .btn, .mb-3 input, .mb-3 select, .submit .btn {
    height: 50px;
  }
 
  .dropdown .form-control, .mb-3 #formFile, .mb-3 .form-select, .submit .btn, .form-label,.form-check-label {
    font-size: 26px;
  }
  #company-selection option {
    font-size: 12px; 
  }
  .submit {
    margin-top: 6%;
  }
  /* Adjust checkbox size */
  input[type="checkbox"] {
    width: 30px;
    height:30px; 
  }
  .form-check-label{
    font-size: 24px;
  }
}

@media screen and (max-width: 768px) {
  form {
    width: 80vw;
    height: auto;
  }
 
  .mb-3 .btn, .mb-3 input, .mb-3 select, .submit .btn {
    height: 50px;
  }
 
  .dropdown .form-control, .mb-3 #formFile, .mb-3 .form-select, .submit .btn, .form-label,.form-check-label {
    font-size: 26px;
  }
  #company-selection option {
    font-size: 12px; 
  }
  /* Adjust checkbox size */
  input[type="checkbox"] {
    width: 30px; 
    height:30px; 
  }
 
  .submit {
    margin-top: 6%;
  }
}
@media screen and (max-width: 428px) {
  form {
    width: 80vw;
    height: auto;
  }
  .mb-3 .btn, .mb-3 input, .mb-3 select, .submit .btn {
    height: 35px;
  }
 
  .dropdown .form-control, .mb-3 #formFile, .mb-3 .form-select, .submit .btn, .form-label,.form-check-label {
    font-size: 18px;
  }
  #company-selection option {
    font-size: 12px; 
  }
  /* Adjust checkbox size */
  input[type="checkbox"] {
    width:20px; 
    height: 20px;
  }
}

@media screen and (max-width: 414px) {
  form {
    width: 90vw;
    height: auto;
  }
  .mb-3 .btn, .mb-3 input, .mb-3 select, .submit .btn {
    height: 35px;
  }
 
  .dropdown .form-control, .mb-3 #formFile, .mb-3 .form-select, .submit .btn, .form-label,.form-check-label {
    font-size: 18px;
  }
  #company-selection option {
    font-size: 12px; 
  }
  /* Adjust checkbox size */
  input[type="checkbox"] {
    width: 20px; 
    height: 20px; 
  }
}
@media screen and (max-width: 412px) {
  form {
    width: 90vw;
    height: auto;
  }
  .mb-3 .btn, .mb-3 input, .mb-3 select, .submit .btn {
    height: 35px;
  }
 
  .dropdown .form-control, .mb-3 #formFile, .mb-3 .form-select, .submit .btn, .form-label,.form-check-label {
    font-size: 18px;
  }
  #company-selection option {
    font-size: 12px; 
  }
  /* Adjust checkbox size */
  input[type="checkbox"] {
    width: 20px; 
    height: 20px; 
  }
}
@media screen and (max-width: 393px) {
  .container {
    padding: 0 15px;
  }
  form {
    width: 90vw;
    height: auto;
  }
  .mb-3 .btn, .mb-3 input, .mb-3 select, .submit .btn {
    height: 35px;
  }
  .dropdown .form-control, .mb-3 #formFile, .mb-3 .form-select, .submit .btn, .form-label,.form-check-label {
    font-size: 18px;
  }
  #company-selection option {
    font-size: 11px; 
  }
  .submit {
    margin-top: 3%;
  }
  .form-check-input {
    width: 20px;
    height: 10px; 
  }
  input[type='checkbox'] {
    width: 20px;
    height: 20px;
    margin-right: 10px;
  }
}

@media screen and (max-width: 360px) {
  .container {
    padding: 0 15px;
  }
  form {
    width: 80vw;
    height: auto;
  }
  .mb-3 .btn, .mb-3 input, .mb-3 select, .submit .btn {
    height: 35px;
  }
 
  .dropdown .form-control, .mb-3 #formFile, .mb-3 .form-select, .submit .btn, .form-label,.form-check-label {
    font-size: 18px;
  }
  #company-selection option {
    font-size: 12px; 
  }
 
  .submit {
    margin-top: 4%;
  }
  .form-check-input {
    width: 20px;
    height: 10px; 
  }
  input[type='checkbox'] {
    width: 20px;
    height: 20px;
    margin-right: 10px;
  }
 
 
}



</style>
