<template>
  <WebLayout>
    <div class="container-fluid">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="margin-left:7%;margin-bottom: 50px">Company Dashboard</h1>
      </div>
      <!-- Content Row -->
      <div class="rowh">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4" style="width: 40%; height: 170px; margin-left: 100px;">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="group_icon">
                <i class="material-icons" style="font-size:90px;color: blue;">group</i>
                <span>Our group</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4" style="width: 40%;" >
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="group_icon">
                <i class="material-icons" style="font-size:90px;color: blue;">attach_money</i>
                <span>List of Money</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7" style="margin-left:100px ;width:83%">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
              class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
              <div class="dropdown no-arrow">
               
               
                <div
                  class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                  aria-labelledby="dropdownMenuLink"
                >
                  <div class="dropdown-header">Dropdown Header:</div>
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <div class="chart-area">
                <canvas id="myAreaChart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </WebLayout>
</template>

<style scoped>
.rowh{
    display: flex;
    gap: 30px;
    
};
.card-body {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%; 
}

.group_icon {
  display: flex;
  flex-direction: column;
  align-items: center;
 

}

.group_icon i {
  margin-bottom: 8px; 
  font-size: 100px;
}


</style>



