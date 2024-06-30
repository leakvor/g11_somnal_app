<template>
    <div class="container mx-auto p-4">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <div class="col-md-12">
            <div class="panel shadow-md rounded-lg bg-white mb-4">
                <div class="panel-body p-6">
                    <textarea class="form-control w-full border border-gray-300 rounded-md p-2" rows="2" placeholder="What are you thinking?"></textarea>
                    <div class="mt-4 flex justify-between items-center">
                        <button class="btn btn-primary px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600"><i class="fa fa-pencil fa-fw"></i> Share</button>
                        <div class="space-x-2">
                            <a class="btn btn-icon text-gray-500 hover:text-gray-700" href="#"><i class="fa fa-video-camera"></i></a>
                            <a class="btn btn-icon text-gray-500 hover:text-gray-700" href="#"><i class="fa fa-camera"></i></a>
                            <a class="btn btn-icon text-gray-500 hover:text-gray-700" href="#"><i class="fa fa-file"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel shadow-md rounded-lg bg-white mb-4">
                <div class="panel-body p-6">
                    <!-- Newsfeed Content -->
                    <div class="media-block mb-4">
                        <a class="media-left mr-4" href="#"><img class="img-circle w-12 h-12" alt="Profile Picture" src="https://bootdey.com/img/Content/avatar/avatar1.png"></a>
                        <div class="media-body">
                            <div class="mb-4">
                                <a href="#" class="text-semibold text-gray-900">Lisa D.</a>
                                <p class="text-muted text-sm"><i class="fa fa-mobile fa-lg"></i> - From Mobile - 11 min ago</p>
                            </div>
                            <p>consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                            <div class="mt-4 flex items-center">
                                <div class="btn-group space-x-2">
                                    <a class="btn btn-sm text-gray-500 hover:text-green-500" href="#"><i class="fa fa-thumbs-up"></i></a>
                                    <a class="btn btn-sm text-gray-500 hover:text-red-500" href="#"><i class="fa fa-thumbs-down"></i></a>
                                </div>
                                <a class="btn btn-sm text-blue-500 hover:text-blue-600 ml-4" href="#">Comment</a>
                            </div>
                            <hr class="my-4">
                            <!-- Comments -->
                            <div class="media-block mb-4">
                                <a class="media-left mr-4" href="#"><img class="img-circle w-12 h-12" alt="Profile Picture" src="https://bootdey.com/img/Content/avatar/avatar2.png"></a>
                                <div class="media-body">
                                    <div class="mb-4">
                                        <a href="#" class="text-semibold text-gray-900">Bobby Marz</a>
                                        <p class="text-muted text-sm"><i class="fa fa-mobile fa-lg"></i> - From Mobile - 7 min ago</p>
                                    </div>
                                    <p>Sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                                    <div class="mt-4 flex items-center">
                                        <div class="btn-group space-x-2">
                                            <a class="btn btn-sm text-green-500" href="#"><i class="fa fa-thumbs-up"></i> You Like it</a>
                                            <a class="btn btn-sm text-gray-500 hover:text-red-500" href="#"><i class="fa fa-thumbs-down"></i></a>
                                        </div>
                                        <a class="btn btn-sm text-blue-500 hover:text-blue-600 ml-4" href="#">Comment</a>
                                    </div>
                                    <hr class="my-4">
                                </div>
                            </div>
                            <div class="media-block">
                                <a class="media-left mr-4" href="#"><img class="img-circle w-12 h-12" alt="Profile Picture" src="https://bootdey.com/img/Content/avatar/avatar3.png"></a>
                                <div class="media-body">
                                    <div class="mb-4">
                                        <a href="#" class="text-semibold text-gray-900">Lucy Moon</a>
                                        <p class="text-muted text-sm"><i class="fa fa-globe fa-lg"></i> - From Web - 2 min ago</p>
                                    </div>
                                    <p>Duis autem vel eum iriure dolor in hendrerit in vulputate ?</p>
                                    <div class="mt-4 flex items-center">
                                        <div class="btn-group space-x-2">
                                            <a class="btn btn-sm text-gray-500 hover:text-green-500" href="#"><i class="fa fa-thumbs-up"></i></a>
                                            <a class="btn btn-sm text-gray-500 hover:text-red-500" href="#"><i class="fa fa-thumbs-down"></i></a>
                                        </div>
                                        <a class="btn btn-sm text-blue-500 hover:text-blue-600 ml-4" href="#">Comment</a>
                                    </div>
                                    <hr class="my-4">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Newsfeed Content -->
                    <!-- Newsfeed Content -->
                    <div class="media-block mb-4">
                        <a class="media-left mr-4" href="#"><img class="img-circle w-12 h-12" alt="Profile Picture" src="https://bootdey.com/img/Content/avatar/avatar1.png"></a>
                        <div class="media-body">
                            <div class="mb-4">
                                <a href="#" class="text-semibold text-gray-900">John Doe</a>
                                <p class="text-muted text-sm"><i class="fa fa-mobile fa-lg"></i> - From Mobile - 11 min ago</p>
                            </div>
                            <p>Lorem ipsum dolor sit amet.</p>
                            <img class="img-responsive rounded-lg mt-4" src="https://www.bootdey.com/image/400x300" alt="Image">
                            <div class="mt-4 flex items-center">
                                <span class="tag bg-white border border-gray-300 text-gray-900 rounded-md px-2 py-1"><i class="fa fa-heart text-red-500"></i> 250 Likes</span>
                                <div class="btn-group space-x-2 ml-4">
                                    <a class="btn btn-sm text-gray-500 hover:text-green-500" href="#"><i class="fa fa-thumbs-up"></i></a>
                                    <a class="btn btn-sm text-gray-500 hover:text-red-500" href="#"><i class="fa fa-thumbs-down"></i></a>
                                </div>
                                <a class="btn btn-sm text-blue-500 hover:text-blue-600 ml-4" href="#">Comment</a>
                            </div>
                            <hr class="my-4">
                            <!-- Comments -->
                            <div class="media-block mb-4">
                                <a class="media-left mr-4" href="#"><img class="img-circle w-12 h-12" alt="Profile Picture" src="https://bootdey.com/img/Content/avatar/avatar2.png"></a>
                                <div class="media-body">
                                    <div class="mb-4">
                                        <a href="#" class="text-semibold text-gray-900">Maria Leanz</a>
                                        <p class="text-muted text-sm"><i class="fa fa-globe fa-lg"></i> - From Web - 2 min ago</p>
                                    </div>
                                    <p>Duis autem vel eum iriure dolor in hendrerit in vulputate ?</p>
                                    <div class="mt-4 flex items-center">
                                        <div class="btn-group space-x-2">
                                            <a class="btn btn-sm text-gray-500 hover:text-green-500" href="#"><i class="fa fa-thumbs-up"></i></a>
                                            <a class="btn btn-sm text-gray-500 hover:text-red-500" href="#"><i class="fa fa-thumbs-down"></i></a>
                                        </div>
                                        <a class="btn btn-sm text-blue-500 hover:text-blue-600 ml-4" href="#">Comment</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Newsfeed Content -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CommentUser',
}
</script>

<style scoped>
body {
    margin-top: 20px;
    background: #ebeef0;
}
</style>
