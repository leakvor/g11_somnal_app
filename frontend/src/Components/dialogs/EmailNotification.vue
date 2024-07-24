<template>
  <div class="alert alert-white text-dark d-flex align-items-center" role="alert">
    <i class="w3-jumbo w3-spin material-icons text-success">cached</i>
    <p class="mt-3">Please waite a few second...</p>
  </div>
</template>

<style scoped>
.alert {
  position: absolute;
  top: 10%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 31%;
  background: white;
  border: 1px solid black;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  z-index: 1000;
}

/* tablets screen */
@media (max-width: 999px) {
  .alert {
    width: 50%;
    top: 5%;
  }
}
/* mobile */
@media (max-width: 768px) {
  .alert{
    width: 90%;
    top: 8%;
  }
}
</style>