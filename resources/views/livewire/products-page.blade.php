<div>
    <!-- Start Accordion -->
    <div class="hs-accordion-group">
        <!-- Start Accordion Item -->
        <div class="hs-accordion hs-accordion-active:border-gray-200 bg-white border border-transparent rounded-xl dark:hs-accordion-active:border-neutral-700 dark:bg-neutral-800 dark:border-transparent" id="hs-active-bordered-heading-one">
            <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 inline-flex justify-between items-center gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-none dark:focus:text-neutral-400" aria-expanded="false" aria-controls="hs-basic-active-bordered-collapse-one">
                Szűrők
                <svg class="hs-accordion-active:hidden block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"></path>
                    <path d="M12 5v14"></path>
                </svg>
                <svg class="hs-accordion-active:block hidden size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"></path>
                </svg>
            </button>
            <div id="hs-basic-active-bordered-collapse-one" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-active-bordered-heading-one">
                <!--Start Accordion Item Content -->
                <div class="pb-4 px-5 grid grid-cols-2">
                    <!--Start Col -->
                    <fieldset>
                        <legend>Kategóriák</legend>
                        
                        <div class="flex">
                            <input type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500  dark:focus:ring-offset-gray-800" id="hs-default-checkbox">
                            <label for="hs-default-checkbox" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Floráriumok</label>
                        </div>
                        <div class="flex">
                            <input type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500  dark:focus:ring-offset-gray-800" id="hs-default-checkbox">
                            <label for="hs-default-checkbox" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Moha-képek</label>
                        </div>
                    </fieldset>
                    <!--End Col -->

                    <!--Start Col -->
                    <fieldset>
                        <legend>Árak</legend>
                        
                        <div class="flex">
                            <input type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500  dark:focus:ring-offset-gray-800" id="hs-default-checkbox">
                            <label for="hs-default-checkbox" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">$</label>
                        </div>
                        <div class="flex">
                            <input type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500  dark:focus:ring-offset-gray-800" id="hs-default-checkbox">
                            <label for="hs-default-checkbox" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">$$</label>
                        </div>
                        <div class="flex">
                            <input type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500  dark:focus:ring-offset-gray-800" id="hs-default-checkbox">
                            <label for="hs-default-checkbox" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">$$$</label>
                        </div>
                    </fieldset>
                    <!--End Col -->

                </div>
                <!--End Accordion Item Content -->
            </div>
        </div>
        <!-- End Accordion Item -->
    </div>
    <!-- End Accordion -->

    <!-- Start Grid -->
    <section class="grid grid-cols-4 gap-4 mt-6">
        <!--Start Col -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <img class="w-full h-auto rounded-t-xl" src="https://images.unsplash.com/photo-1680868543815-b8666dba60f7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=320&q=80" alt="Card Image">
            <div class="p-4 md:p-5">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                    Card title
                </h3>
                <p class="mt-1 text-gray-500 dark:text-neutral-400">
                    Some quick example text to build on the card title and make up the bulk of the card's content.
                </p>
                <a class="mt-2 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="{{ route('product', ['product' => 'one']) }}">
                    Go somewhere
                </a>
            </div>
        </div>
        <!--End Col -->
        <!--Start Col -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <img class="w-full h-auto rounded-t-xl" src="https://images.unsplash.com/photo-1680868543815-b8666dba60f7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=320&q=80" alt="Card Image">
            <div class="p-4 md:p-5">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                    Card title
                </h3>
                <p class="mt-1 text-gray-500 dark:text-neutral-400">
                    Some quick example text to build on the card title and make up the bulk of the card's content.
                </p>
                <a class="mt-2 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
                    Go somewhere
                </a>
            </div>
        </div>
        <!--End Col -->
        <!--Start Col -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <img class="w-full h-auto rounded-t-xl" src="https://images.unsplash.com/photo-1680868543815-b8666dba60f7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=320&q=80" alt="Card Image">
            <div class="p-4 md:p-5">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                    Card title
                </h3>
                <p class="mt-1 text-gray-500 dark:text-neutral-400">
                    Some quick example text to build on the card title and make up the bulk of the card's content.
                </p>
                <a class="mt-2 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
                    Go somewhere
                </a>
            </div>
        </div>
        <!--End Col -->
        <!--Start Col -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <img class="w-full h-auto rounded-t-xl" src="https://images.unsplash.com/photo-1680868543815-b8666dba60f7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=320&q=80" alt="Card Image">
            <div class="p-4 md:p-5">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                    Card title
                </h3>
                <p class="mt-1 text-gray-500 dark:text-neutral-400">
                    Some quick example text to build on the card title and make up the bulk of the card's content.
                </p>
                <a class="mt-2 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
                    Go somewhere
                </a>
            </div>
        </div>
        <!--End Col -->
        <!--Start Col -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <img class="w-full h-auto rounded-t-xl" src="https://images.unsplash.com/photo-1680868543815-b8666dba60f7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=320&q=80" alt="Card Image">
            <div class="p-4 md:p-5">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                    Card title
                </h3>
                <p class="mt-1 text-gray-500 dark:text-neutral-400">
                    Some quick example text to build on the card title and make up the bulk of the card's content.
                </p>
                <a class="mt-2 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
                    Go somewhere
                </a>
            </div>
        </div>
        <!--End Col -->
        <!--Start Col -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <img class="w-full h-auto rounded-t-xl" src="https://images.unsplash.com/photo-1680868543815-b8666dba60f7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=320&q=80" alt="Card Image">
            <div class="p-4 md:p-5">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                    Card title
                </h3>
                <p class="mt-1 text-gray-500 dark:text-neutral-400">
                    Some quick example text to build on the card title and make up the bulk of the card's content.
                </p>
                <a class="mt-2 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
                    Go somewhere
                </a>
            </div>
        </div>
        <!--End Col -->
    </section>
    <!-- End Grid -->
</div>
