<script setup lang="ts">
import { Icon } from '@iconify/vue'
</script>
<template>
    <footer class="footer p-4" >
        <div class="row">
            <div class="col-md-3">
                <h6>About Sonal</h6>
                <p>
                    Sonal Solution is a comprehensive platform that provides innovative and
            sustainable solutions to address the challenges faced by individuals
            and communities. Our mission is to empower people and create a better
            future through the application of cutting-edge technology and
            collaborative initiatives.
                </p>
            </div>
            <div class="col-md-2">
                <h6>Products</h6>
                <ul class="list-unstyled">
                    <li><router-link to="/adjay">Scrap</router-link></li>
                    <li><router-link to="/drain">Scrap</router-link></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6>Useful Links</h6>
                <ul class="list-unstyled">
                    <li><router-link to="/" >Home</router-link></li>
                    <li><router-link to="/service" >Service</router-link></li>
                    <li><router-link to="about">About Us</router-link></li>
                    <li><router-link  to="/">Our Partner</router-link></li>
                    <li><router-link to="/">Register</router-link></li>
                    <li><router-link to="/">Login</router-link></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6>Contact</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="d-flex align-items-center"><i class="material-icons pe-2">location_on</i> New York, NY 10012, US</a></li>
                    <li><a href="#" class="d-flex align-items-center"><i class="material-icons pe-2">mail</i>info@gmail.com</a></li>
                    <li><a href="#" class="d-flex align-items-center"><i class="material-icons pe-2">phone</i> (+855) 01 234 567 88</a></li>
                </ul>
            </div>
        </div>
        <hr class="my-3">
        <div class="row">
            <div class="col-md-7 text-center text-md-start">
                <p>&copy; 2024 Sonal. All rights reserved.</p>
            </div>
            <div class="col-md-5 text-center text-md-end">
                <div class="social-icons">
                    <a class="btn btn-outline-light btn-floating m-1"><i class="fa-brands fa-facebook"></i></a>
                    <a class="btn btn-outline-light btn-floating m-1"><i class="fa-brands fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-floating m-1"><i
                            class="fa-brands fa-instagram"></i></a>
                    <a class="btn btn-outline-light btn-floating m-1"><i
                            class="fa-brands fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </footer>
</template>


<style scoped>
.footer {
    background-color: #212529;
    color: white;
    padding-top: 3rem;
}

.footer a {
    color: #adb5bd;
    text-decoration: none;
    transition: color 0.3s ease-in-out, transform 0.3s ease-in-out;
}

.footer a:hover {
    color: #de8e17;
}
.social-icons a:hover {
    transform: translateX(5px);
}

.footer h6 {
    color: #ffffff;
    margin-bottom: 1rem;
    font-weight: bold;
}

.footer ul li {
    margin-bottom: 0.5rem;
}

.footer .btn-floating {
    border-radius: 50%;
    transition: all 0.3s ease-in-out;
}

.footer .btn-floating:hover {
    background-color: #495057;
    color: white;
}

.footer .social-icons a {
    color: #adb5bd;
}

.footer .social-icons a:hover {
    color: #ffffff;
    background-color: #343a40;
}

.footer hr {
    border-top: 1px solid #495057;
}
</style>