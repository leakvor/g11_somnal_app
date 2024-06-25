<x-app-layout>
    <div>
         <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
             <div class="container mx-auto px-6 py-1 pb-16">
               <div class="bg-white shadow-md rounded my-6 p-5">
                 <form method="POST" action="{{ route('admin.categories.store') }}">
                   @csrf
                   <div class="flex flex-col space-y-2">
                     <label for="title" class="text-gray-700 select-none font-medium">Name Category</label>
                     <input id="title" type="text" name="name" value="{{ old('name') }}"
                       placeholder="Enter Name" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                     />
                 </div>
                 <div class="text-center mt-16 mb-16">
                   <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Submit</button>
                 </div>
               </div>
 
              
             </div>
         </main>
     </div>
 </div>
 </x-app-layout>
 