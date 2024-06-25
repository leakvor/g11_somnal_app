<script setup lang="ts">
import { Icon } from '@iconify/vue'
</script>
<template>
  <div class="footer d-flex p-14 bg-teal-900  color-white">
    <div class="about-somnal mr-50">
        <div class="logo d-flex ml-10 tex-center">
            <!-- <img src="../assets/image/logo.png" alt="logo" class="w-10 h-10"> -->
            <h5>About Somnal</h5>
        </div>
        <p>Whether it's a residential property, a commercial establishment, or scrap materials, [Your Company Name] is your go-to solution for all drain-related and scrap buying concerns. Contact us today through our website and experience the best in drain services.</p>
    </div>
    <div class="navigation ml-30 mr-50">
        <h5>Navigation</h5>
        <a href="#" class="color-white no-underline">Home</a> <br/>
        <a href="#" class="color-white no-underline">Service</a><br/>
        <a href="#" class="color-white no-underline">About Us</a><br/>
        <a href="#" class="color-white no-underline">Contact US</a>
    </div>
    <div class="contact-us">
        <h5>Contact Us</h5>
        <div class="icon-contact flex items-center space-x-2">
            <Icon icon="mdi-phone"/>
            <p>+628123456789</p>
        </div>
        <div class="icon-contact">

        </div>
    </div>
  </div>
</template>


<style>

</style>