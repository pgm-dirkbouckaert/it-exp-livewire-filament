<div class="{{ $this->showModalLogin ? '' : 'hidden' }}">
  <div class="z-10 h-full w-full fixed bg-gray-500 opacity-75">
  </div>
  <div class="h-full w-full flex justify-center items-center">
    <div
      class="z-20 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2
             min-w-[300px] max-w-[450px] min-h-[100px] bg-white rounded 
             flex flex-col justify-center items-center"
    >
      <p>Please login to continue</p>
      <div class="mt-4 flex gap-4">
        <a
          wire:click="closeModalLogin"
          href="{{ route('login') }}"
          class="text-amber-600 hover:text-amber-700"
        >OK</a>
        <button wire:click="closeModalLogin">Cancel</button>

      </div>
    </div>
  </div>
</div>
