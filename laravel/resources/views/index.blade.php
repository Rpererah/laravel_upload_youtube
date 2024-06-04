<x-layout title="View Singers">

    <section class="banner bg-gray-800 text-white py-8 px-4">
      <h1 class="text-3xl font-bold">Singers</h1>
      <p class="text-gray-500">Browse talented singers and manage their information.</p>
    </section>
  
    <section class="singer-list grid grid-cols-1 md:grid-cols-3 gap-4 px-4 py-8">
      @forelse ($singers as $singer)
        <div class="singer-card bg-white rounded-lg shadow-md overflow-hidden">
          <header>
            <h1 class="text-xl font-bold px-4 py-2">{{ $singer->name }}</h1>
          </header>
          <main class="px-4 py-2">
            <img src="{{ asset('storage/' . $singer->photo) }}" alt="{{ $singer->name }}" class="w-full h-48 object-cover rounded-t-lg">
            <p class="text-gray-600 pt-2">Age: {{ $singer->age }}</p>
          </main>
          <footer class="flex justify-between px-4 py-2">
            <a href="{{ route('singer.edit', $singer->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
            <form id="delete-form-{{ $singer->id }}" action="{{ route('singer.destroy', $singer->id) }}" method="post" style="display: none;">
              @csrf
              @method('DELETE')
            </form>
            <button data-singer-id="{{ $singer->id }}" class="text-red-500 hover:text-red-700 delete-singer-btn">Delete</button>
          </footer>
        </div>
      @empty
        <p class="text-gray-500 text-center px-4">There are no singers to display yet.</p>
      @endforelse
    </section>
  
    <a href="{{ route('singer.create') }}" class="add-singer-btn bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-700">Add New Singer</a>
  
    <div class="modal hidden fixed inset-0 bg-gray-300 bg-opacity-50 overflow-y-auto px-4 py-6 sm:px-0">
        <div class="modal-content relative bg-blue-700 text-white rounded-lg shadow-dark dark:bg-gray-800 outline-none mx-auto w-full max-w-sm">
          <div class="modal-header flex items-center justify-between p-4 border-b dark:border-gray-700">
            <h5 class="text-xl font-medium leading-normal modal-title">Confirm Delete</h5>
            
          </div>
          <div class="modal-body p-4 text-center">
            <p>Are you sure you want to delete this singer?</p>
          </div>
          <div class="modal-footer flex items-center justify-center p-4 border-t dark:border-gray-700">
            <button type="button" data-close-btn class="px-4 py-2 rounded-md text-sm bg-gray-500 hover:bg-gray-600 focus:outline-none cancel-delete-btn">Cancel</button>
            <span class="mx-2">  </span>
            <button type="button" data-singer-id="" data-submit-btn class="px-4 py-2 rounded-md text-sm bg-red-500 hover:bg-red-700 focus:outline-none">Delete</button>
          </div>
        </div>
      </div>
      
      
  
    <script>
    const deleteButtons = document.querySelectorAll('.delete-singer-btn');
    const modal = document.querySelector('.modal');
    const cancelButton = document.querySelector('.cancel-delete-btn');
    const submitButton = document.querySelector('[data-submit-btn]');

    deleteButtons.forEach(button => {
      button.addEventListener('click', function() {
        const singerId = this.dataset.singerId;
        const deleteForm = document.getElementById(`delete-form-${singerId}`);
        submitButton.dataset.singerId = singerId;

        modal.classList.remove('hidden'); 
      });
    });

    cancelButton.addEventListener('click', () => {
      modal.classList.add('hidden'); 
    });

    submitButton.addEventListener('click', () => {
      const singerId = submitButton.dataset.singerId;
      const deleteForm = document.getElementById(`delete-form-${singerId}`);
      deleteForm.submit(); 
      modal.classList.add('hidden'); 
    });
  </script>


</x-layout>