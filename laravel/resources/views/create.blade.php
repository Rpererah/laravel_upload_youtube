<x-layout title="Create New Singer">

    <section class="banner bg-gray-800 text-white py-8 px-4">
      <h1 class="text-3xl font-bold">Create a New Singer</h1>
      <p class="text-gray-500">Add a talented singer to the database.</p>
    </section>
  
    <section class="container mx-auto px-4 py-8">
      <form enctype="multipart/form-data" action="{{ route('singer.store') }}" method="post" class="grid grid-cols-1 gap-4">
        @csrf
  
        <div class="col-span-full">
          <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
          <input type="text" id="name" name="name" placeholder="Enter Singer's Name" class="shadow-sm rounded-md w-full px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>
  
        <div class="col-span-full">
          <label for="photo" class="block text-gray-700 font-bold mb-2">Singer Photo:</label>
          <input type="file" name="photo" id="photo" class="shadow-sm rounded-md w-full px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>
  
        <div class="col-span-full">
          <label for="age" class="block text-gray-700 font-bold mb-2">Age:</label>
          <input type="number" name="age" id="age" placeholder="Enter Singer's Age" class="shadow-sm rounded-md w-full px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>
  
        <div class="col-span-full text-right">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md shadow-sm">Create Singer</button>
        </div>
      </form>
    </section>
  
  </x-layout>
  