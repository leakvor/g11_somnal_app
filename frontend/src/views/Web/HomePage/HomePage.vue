<template>
  <div class="pb-5">
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
          aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
          aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="2000">
          <img
            src="../../../assets/Slider/slider-1.png"
            class="d-block w-100" alt="..." />
        </div>
        <div class="carousel-item" data-bs-interval="2000">
          <img
            src="../../../assets/Slider/slider-2.png"
            class="d-block w-100" alt="..." />
        </div>
        <div class="carousel-item">
          <img
            src="../../../assets/Slider/slider-3.png"
            class="d-block w-100" alt="..." />
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <div class="button-group d-flex justify-content-end pt-5 pe-3">
      <a href="" type="button" class="btn btn-success d-flex align-items-center me-3 p-3">
        <i class="material-icons icon-align">add_shopping_cart</i>
        <span>Sale Now</span>
      </a>
      <a href="" type="button" class="btn btn-primary text-white d-flex align-items-center"> 
        <i class="material-icons icon-align">shopping_bag</i>
        <span>Buy Now</span>
      </a>
    </div>

    <div class="table-responsive bg-white  mt-5 pe-3 ps-3">
      <h3 class="text-secondary font-bold pb-3 pt-2">Scrap Price List</h3>
      <table class="table text-nowrap table-striped table-hover ">
        <thead class="table-dark text-white">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Scrap Name</th>
            <th scope="col">Date</th>
            <th scope="col">Fee</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in items" :key="index">
            <th scope="row">{{ index + 1 }}</th>
            <td>{{ item.scrapName }}</td>
            <td>{{ item.date }}</td>
            <td ><span class="text-danger font-bold">${{ item.fee }}</span><span class="text-success">/kg</span></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="list-company mt-3 p-3 bg-white">
      <h3 class="text-secondary font-bold pb-3">Top 5 Company</h3>
      <div class=" d-flex justify-content-end pt-2 pb-4"><a href="" class=" btn btn-success text-decoration-none text-white text-right">See All...</a></div>
      <div class="list-container pb-5">
        <a v-for="(company, index) in companies" :key="index" href=""
          class="card company-card text-decoration-none text-dark pe-3 ps-3 pb-3">
          <div class="card-body">
            <div class="company-logo text-center">
              <img src="../../../assets/company-logo/company-logo.png" alt="Company Logo" />
            </div>
            <div class="company-info">
              <h5 class="text-title">{{ company.name }}</h5>
              <p class="text-card text-danger">{{ company.service }}</p>
              <p class="text-card">{{ company.address }}</p>
              <a :href="'tel:' + company.tel" class="text-card text-decoration-none">{{ company.tel }}</a>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'HomePage',
  data() {
    return {
      items: [
        { scrapName: 'Scrap Name', date: '20/June/2024', fee: 10 },
        { scrapName: 'Scrap Name', date: '20/June/2024', fee: 2 },
        { scrapName: 'Scrap Name', date: '20/June/2024', fee: 2 },
        { scrapName: 'Scrap Name', date: '20/June/2024', fee: 1 },
        { scrapName: 'Scrap Name', date: '20/June/2024', fee: 0.5 },
        { scrapName: 'Scrap Name', date: '20/June/2024', fee: 1 },
        { scrapName: 'Scrap Name', date: '20/June/2024', fee: 1 },
        { scrapName: 'Scrap Name', date: '20/June/2024', fee: 1 },
        { scrapName: 'Scrap Name', date: '20/June/2024', fee: 1 },
        { scrapName: 'Scrap Name', date: '20/June/2024', fee: 1 },
        { scrapName: 'Scrap Name', date: '20/June/2024', fee: 1 },
        { scrapName: 'Scrap Name', date: '20/June/2024', fee: 1 },
        { scrapName: 'Scrap Name', date: '20/June/2024', fee: 1 },
        { scrapName: 'Scrap Name', date: '20/June/2024', fee: 1 },
        { scrapName: 'Scrap Name', date: '20/June/2024', fee: 1 },
      ],
      companies: [
        {
          name: 'Company 1',
          service: 'service 1',
          address: 'Phnom Penh',
          tel: '012 345 6789',
          image: 'company-logo.png',
          description: 'Description for Company 1'
        },
        {
          name: 'Company 2',
          service: 'service 2',
          address: 'Phnom Penh',
          tel: '012 345 6789',
          image: 'company-logo.png',
          description: 'Description for Company 2'
        },
        {
          name: 'Company 2',
          service: 'service 2',
          address: 'Phnom Penh',
          tel: '012 345 6789',
          image: 'company-logo.png',
          description: 'Description for Company 2'
        },
        {
          name: 'Company 2',
          service: 'service 2',
          address: 'Phnom Penh',
          tel: '012 345 6789',
          image: 'company-logo.png',
          description: 'Description for Company 2'
        },
        {
          name: 'Company 2',
          service: 'service 2',
          address: 'Phnom Penh',
          tel: '012 345 6789',
          image: 'company-logo.png',
          description: 'Description for Company 2'
        },
      ]
    }
  }
}
</script>

<style scoped>
.carousel-item img {
  height: 600px;
  object-fit: cover;
  object-position: center;
  filter: brightness(70%);
}

.list-container {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 1rem;
}

.company-card {
  border-radius: 0.5rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out, border-color 0.3s ease-in-out;
  position: relative;
  overflow: hidden;
  border: 2px solid thick;
}


.company-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  border-color: #007bff;
}


.company-card img {
  width: 110px;
  height: 110px;
  object-fit: fill;
  
}

.text-card {
  line-height: 1px;
  font-size: 12px;
}

@media (min-width: 1200px) {
  .list-container {
    grid-template-columns: repeat(5, 1fr);
  }
}

@media (min-width: 768px) and (max-width: 1199px) {
  .carousel-item img {
    height: 100%;
  }

  .list-container {
    grid-template-columns: repeat(3, 1fr);
  }
}

@media (max-width: 767px) {
  .carousel-item img {
    height: 200px;
  }

  .list-container {
    grid-template-columns: repeat(2, 1fr);
  }
  .company-card img {
  width: 70px;
  height: 70px;
  
}
.company-card .company-info h5{
  margin-top: 5px;
  font-size: 12px;
  font-weight: bold;
}
}
</style>
