<template>
    <WebLayout>
      <section style="background-color: #CDC4F9;">
        <div class="container py-5">
          <div class="row">
            <div class="col-md-12">
              <div class="card" id="chat3" style="border-radius: 15px;">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">
                      <div class="p-3">
                        <div class="input-group rounded mb-3">
                          <input
                            type="search"
                            class="form-control rounded"
                            placeholder="Search"
                            aria-label="Search"
                            aria-describedby="search-addon"
                          />
                          <span class="input-group-text border-0" id="search-addon">
                            <i class="fas fa-search"></i>
                          </span>
                        </div>
                        <div
                          data-mdb-perfect-scrollbar-init
                          class="chat-list"
                          style="position: relative; height: 400px; overflow-y: auto;"
                        >
                          <ul class="list-unstyled mb-0">
                            <li class="p-2 border-bottom">
                              <a href="#!" class="d-flex justify-content-between">
                                <div class="d-flex flex-row">
                                  <div>
                                    <img
                                      src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                      alt="avatar"
                                      class="d-flex align-self-center me-3"
                                      width="60"
                                    />
                                    <span class="badge bg-success badge-dot"></span>
                                  </div>
                                  <div class="pt-1">
                                    <p class="fw-bold mb-0">Marie Horwitz</p>
                                    <p class="small text-muted">Hello, Are you there?</p>
                                  </div>
                                </div>
                                <div class="pt-1">
                                  <p class="small text-muted mb-1">Just now</p>
                                  <span class="badge bg-danger rounded-pill float-end">3</span>
                                </div>
                              </a>
                            </li>
                            <!-- Additional chat list items -->
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-7 col-xl-8">
                      <div
                        class="pt-3 pe-3 chat-content"
                        data-mdb-perfect-scrollbar-init
                        style="position: relative; height: 400px; overflow-y: auto;"
                      >
                        <div class="d-flex flex-row justify-content-start">
                          <img
                            src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                            alt="avatar 1"
                            style="width: 45px; height: 100%;"
                          />
                          <div>
                            <p class="small p-2 ms-3 mb-1 rounded-3 bg-body-tertiary">
                              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                              eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            </p>
                            <p class="small ms-3 mb-3 rounded-3 text-muted float-end">
                              12:00 PM | Aug 13
                            </p>
                          </div>
                        </div>
                        <!-- Additional chat content items -->
                      </div>
                      <div class="text-muted d-flex justify-content-start align-items-center pe-3 pt-3 mt-2">
                        <img
                          src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                          alt="avatar 3"
                          style="width: 40px; height: 100%;"
                        />
                        <input
                          type="text"
                          class="form-control form-control-lg"
                          id="exampleFormControlInput2"
                          placeholder="Type message"
                         
                        />
                        <button > <i class="fas fa-paperclip">Send</i></button>
                      
                      </div>
                    </div>
                   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </WebLayout>
  </template>
  

<style scoped>
#chat3 .form-control {
  border-color: transparent;
}
#chat3 .form-control:focus {
  border-color: transparent;
  box-shadow: inset 0px 0px 0px 1px transparent;
}
.badge-dot {
  border-radius: 50%;
  height: 10px;
  width: 10px;
  margin-left: 2.9rem;
  margin-top: -0.75rem;
}
.chat-list {
  overflow-y: auto;
}
.chat-content {
  overflow-y: auto;
}
</style>
