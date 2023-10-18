<aside id="menu"
    class="w-full lg:w-[260px] h-screen fixed lg:sticky top-0 -left-full lg:left-0 z-30 lg:z-0 transition-all duration-200 pointer-events-none lg:pointer-events-auto">
    <div class="w-full h-full bg-gray-900 bg-opacity-60 relative">
        <button x-toggle="#menu" x-property="left-0, -left-full, pointer-events-none, lg:w-[260px], lg:w-0"
            class="w-[42px] h-[42px] flex items-center justify-center rounded-full absolute top-4 right-4 text-white outline-none hover:bg-white hover:bg-opacity-10 focus:bg-white focus:bg-opacity-10">
            <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                <path
                    d="M12.45 37.65 10.35 35.55 21.9 24 10.35 12.45 12.45 10.35 24 21.9 35.55 10.35 37.65 12.45 26.1 24 37.65 35.55 35.55 37.65 24 26.1Z" />
            </svg>
        </button>
    </div>
    <nav
        class="w-9/12 max-w-[260px] lg:w-full h-full flex flex-col gap-6 bg-white absolute top-0 left-0 border-r border-gray-300 overflow-y-auto">
        <header class="w-full flex items-center justify-center">
            <img src="{{ asset('logo.png') }}" class="h-[106px] block" />
        </header>
        <ul class="flex flex-col">
            <li class="w-full">
                <a href="{{ route('views.dashboard') }}"
                    class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-primary hover:bg-opacity-60 focus:bg-opacity-60 {{ System::activeLink('views.dashboard') }}">
                    <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 96 960 960">
                        <path
                            d="M504 430V220q0-18.9 13.05-31.95T549 175h287q18.9 0 31.95 13.05T881 220v210q0 20.3-13.05 33.15Q854.9 476 836 476H549q-18.9 0-31.95-12.85T504 430ZM78 577V220q0-18.9 13.338-31.95Q104.675 175 124 175h284q18.9 0 31.95 13.05T453 220v357q0 18.9-13.05 31.95T408 622H124q-19.325 0-32.662-13.05Q78 595.9 78 577Zm426 352V573q0-20.3 13.05-33.15Q530.1 527 549 527h287q18.9 0 31.95 12.85T881 573v356q0 20.325-13.05 33.662Q854.9 976 836 976H549q-18.9 0-31.95-13.338Q504 949.325 504 929Zm-426 0V719q0-18.9 13.338-31.95Q104.675 674 124 674h284q18.9 0 31.95 13.05T453 719v210q0 20.325-13.05 33.662Q426.9 976 408 976H124q-19.325 0-32.662-13.338Q78 949.325 78 929Z" />
                    </svg>
                    <span class="text-sm font-medium">Dashboard</span>
                </a>
            </li>
            <li class="w-full flex flex-col">
                <button x-toggle="#sub-6, #sub-show-6, #sub-hide-6" x-property="hidden, flex"
                    class="w-full flex flex-wrap gap-2 justify-between items-center px-4 py-2 cursor-pointer outline-none text-gray-900">
                    <div class="w-max flex gap-2 flex-wrap items-center">
                        <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 96 960 960">
                            <path
                                d="M444 901H338q-14.297 45.688-52.564 72.844Q247.17 1001 199.943 1001q-60.726 0-102.835-42.109Q55 916.783 55 856.057q0-47.227 27.156-85.493Q109.312 732.297 155 718V432q-46-12-73-50.415t-27-85.642Q55 234.8 97.109 192.4 139.216 150 199.942 150q47.227 0 85.493 27.656Q323.703 205.312 338 250h104l-34-36q-14-13.5-14-32.408t13.217-31.75Q420.133 137 438.967 137.5 457.8 138 472 150l114 113q12 13.545 12 33.273Q598 316 586 328L472 440q-8 7-15.052 12-7.051 5-13.5 6Q437 459 427 455.5t-18.941-14.833q-14.226-12.758-13.642-32.212Q395 389 408 376l35-35H338q-11 35-34.5 58.5T246 432v285.633q33.712 11.637 57.233 35.151Q326.753 776.297 338 810h104l-34-36q-15-11.5-14.5-30.708t14.109-32.45Q420.733 698 439.7 698t32.3 12l114 113q12 13.545 12 33.273Q598 876 586 888l-114 112q-5 5-24-2.5T413 983q-16-7-22.143-4.5-6.143 2.5 17.202 22.17Q395 989 394.5 970t13.5-33l36-36Zm316.176 100q-60.676 0-102.926-42.125T615 856q0-47.69 27.156-85.217Q669.312 733.257 715 718V432q-46-13-73-50.604T615 296q0-61.167 42.056-103.583Q699.113 150 759.765 150t103.443 42.417Q906 234.833 906 296q0 47.812-27.5 85.406Q851 419 806 432v286q44.688 14.77 72.344 52.715Q906 808.66 906 856.057q0 60.726-42.365 102.834Q821.27 1001 760.176 1001ZM199.5 909q24.45 0 39.975-14.737Q255 879.525 255 856.5q0-24.45-15.393-39.975Q224.215 801 199.982 801q-23.957 0-38.47 15.393Q147 831.785 147 856.018q0 23.957 14.737 38.469Q176.475 909 199.5 909Zm560 0q24.45 0 39.975-14.737Q815 879.525 815 856.5q0-24.45-15.393-39.975Q784.215 801 759.982 801q-23.957 0-38.469 15.393Q707 831.785 707 856.018q0 23.957 14.738 38.469Q736.475 909 759.5 909Zm-560-560q24.45 0 39.975-14.738Q255 319.525 255 296.5q0-24.45-15.393-39.975Q224.215 241 199.982 241q-23.957 0-38.47 15.393Q147 271.785 147 296.018q0 23.957 14.737 38.469Q176.475 349 199.5 349Zm560 0q24.45 0 39.975-14.738Q815 319.525 815 296.5q0-24.45-15.393-39.975Q784.215 241 759.982 241q-23.957 0-38.469 15.393Q707 271.785 707 296.018q0 23.957 14.738 38.469Q736.475 349 759.5 349ZM199.982 909q-23.957 0-38.47-14.737Q147 879.525 147 856.5q0-24.45 14.737-39.975Q176.475 801 199.5 801q24.45 0 39.975 15.393Q255 831.785 255 856.018q0 23.957-15.393 38.469Q224.215 909 199.982 909Zm560 0q-23.957 0-38.469-14.737Q707 879.525 707 856.5q0-24.45 14.738-39.975Q736.475 801 759.5 801q24.45 0 39.975 15.393Q815 831.785 815 856.018q0 23.957-15.393 38.469Q784.215 909 759.982 909Zm-560-560q-23.957 0-38.47-14.738Q147 319.525 147 296.5q0-24.45 14.737-39.975Q176.475 241 199.5 241q24.45 0 39.975 15.393Q255 271.785 255 296.018q0 23.957-15.393 38.469Q224.215 349 199.982 349Zm560 0q-23.957 0-38.469-14.738Q707 319.525 707 296.5q0-24.45 14.738-39.975Q736.475 241 759.5 241q24.45 0 39.975 15.393Q815 271.785 815 296.018q0 23.957-15.393 38.469Q784.215 349 759.982 349Z" />
                        </svg>
                        <span class="text-sm font-black">General</span>
                    </div>
                    <svg id="sub-show-6" class="hidden w-4 h-4 text-gray-900 pointer-events-none" fill="currentcolor"
                        viewBox="0 0 48 48">
                        <path d="M24 31.8 10.9 18.7 14.2 15.45 24 25.35 33.85 15.5 37.1 18.75Z"></path>
                    </svg>
                    <svg id="sub-hide-6" class="flex w-4 h-4 pointer-events-none" fill="currentcolor"
                        viewBox="0 0 48 48">
                        <path
                            d="M17.2 35.45q-.7-.75-.7-1.675t.7-1.575l8.2-8.25-8.25-8.3q-.7-.6-.675-1.6.025-1 .725-1.65.65-.7 1.575-.675.925.025 1.575.675l9.95 9.95q.3.3.5.725t.2.875q0 .5-.2.9t-.5.7l-9.9 9.9q-.65.65-1.6.625-.95-.025-1.6-.625Z" />
                    </svg>
                </button>
                <ul id="sub-6" class="w-full hidden flex-col border-y border-gray-300">
                    <li class="w-full">
                        <a href="{{ route('views.projects.index') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-primary hover:bg-opacity-60 focus:bg-opacity-60 {{ System::activeLink('views.projects.index') }}">
                            <div class="w-4 h-4 flex items-center justify-center"><span
                                    class="w-1.5 h-1.5 rounded-full bg-gray-900"></span></div>
                            <span class="text-sm font-medium">Projects</span>
                        </a>
                    </li>
                    <li class="w-full">
                        <a href="{{ route('views.tasks.index') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-primary hover:bg-opacity-60 focus:bg-opacity-60 {{ System::activeLink('views.tasks.index') }}">
                            <div class="w-4 h-4 flex items-center justify-center"><span
                                    class="w-1.5 h-1.5 rounded-full bg-gray-900"></span></div>
                            <span class="text-sm font-medium">Tasks</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="w-full flex flex-col">
                <button x-toggle="#sub-1, #sub-show-1, #sub-hide-1" x-property="hidden, flex"
                    class="w-full flex flex-wrap gap-2 justify-between items-center px-4 py-2 cursor-pointer outline-none text-gray-900">
                    <div class="w-max flex gap-2 flex-wrap items-center">
                        <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 96 960 960">
                            <path
                                d="M303 554q-26.5 0-39.75-24t.75-47l178-287q12.643-22 38.321-22Q506 174 519 196l180 287q12 23-.75 47T659 554H303Zm423.235 463Q645 1017 587.5 959.946 530 902.892 530 820.529 530 739 587.5 681t138.735-58q82.069 0 138.917 58T922 821.029q0 82.03-56.848 139Q808.304 1017 726.235 1017ZM111 992q-20.15 0-33.075-12.925Q65 966.15 65 946V689q0-19.575 12.925-33.287Q90.85 642 111 642h258q19.15 0 32.075 13.713Q414 669.425 414 689v257q0 20.15-12.925 33.075Q388.15 992 369 992H111Z" />
                        </svg>
                        <span class="text-sm font-black">Company</span>
                    </div>
                    <svg id="sub-show-1" class="hidden w-4 h-4 text-gray-900 pointer-events-none" fill="currentcolor"
                        viewBox="0 0 48 48">
                        <path d="M24 31.8 10.9 18.7 14.2 15.45 24 25.35 33.85 15.5 37.1 18.75Z"></path>
                    </svg>
                    <svg id="sub-hide-1" class="flex w-4 h-4 pointer-events-none" fill="currentcolor"
                        viewBox="0 0 48 48">
                        <path
                            d="M17.2 35.45q-.7-.75-.7-1.675t.7-1.575l8.2-8.25-8.25-8.3q-.7-.6-.675-1.6.025-1 .725-1.65.65-.7 1.575-.675.925.025 1.575.675l9.95 9.95q.3.3.5.725t.2.875q0 .5-.2.9t-.5.7l-9.9 9.9q-.65.65-1.6.625-.95-.025-1.6-.625Z" />
                    </svg>
                </button>
                <ul id="sub-1" class="w-full hidden flex-col border-y border-gray-300">
                    <li class="w-full">
                        <a href="{{ route('views.departments.index') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-primary hover:bg-opacity-60 focus:bg-opacity-60 {{ System::activeLink('views.departments.index') }}">
                            <div class="w-4 h-4 flex items-center justify-center"><span
                                    class="w-1.5 h-1.5 rounded-full bg-gray-900"></span></div>
                            <span class="text-sm font-medium">Departements</span>
                        </a>
                    </li>
                    <li class="w-full">
                        <a href="{{ route('test') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-primary hover:bg-opacity-60 focus:bg-opacity-60 {{ System::activeLink('test') }} bg-red-500 bg-opacity-10">
                            <div class="w-4 h-4 flex items-center justify-center"><span
                                    class="w-1.5 h-1.5 rounded-full bg-gray-900"></span></div>
                            <span class="text-sm font-medium">Designations</span>
                        </a>
                    </li>
                    <li class="w-full">
                        <a href="{{ route('test') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-primary hover:bg-opacity-60 focus:bg-opacity-60 {{ System::activeLink('test') }} bg-red-500 bg-opacity-10">
                            <div class="w-4 h-4 flex items-center justify-center"><span
                                    class="w-1.5 h-1.5 rounded-full bg-gray-900"></span></div>
                            <span class="text-sm font-medium">Reports</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="w-full flex flex-col">
                <button x-toggle="#sub-2, #sub-show-2, #sub-hide-2" x-property="hidden, flex"
                    class="w-full flex flex-wrap gap-2 justify-between items-center px-4 py-2 cursor-pointer outline-none text-gray-900">
                    <div class="w-max flex gap-2 flex-wrap items-center">
                        <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                            <path
                                d="m18.95 37.9-5.3-11.55-11.6-5.3 11.6-5.25 5.3-11.55 5.2 11.55 11.65 5.25-11.65 5.3Zm18.6 5.8-2.6-5.8-5.85-2.6 5.85-2.65 2.6-5.8 2.6 5.8L46 35.3l-5.85 2.6Z" />
                        </svg>
                        <span class="text-sm font-black">Client services</span>
                    </div>
                    <svg id="sub-show-2" class="hidden w-4 h-4 text-gray-900 pointer-events-none" fill="currentcolor"
                        viewBox="0 0 48 48">
                        <path d="M24 31.8 10.9 18.7 14.2 15.45 24 25.35 33.85 15.5 37.1 18.75Z"></path>
                    </svg>
                    <svg id="sub-hide-2" class="flex w-4 h-4 pointer-events-none" fill="currentcolor"
                        viewBox="0 0 48 48">
                        <path
                            d="M17.2 35.45q-.7-.75-.7-1.675t.7-1.575l8.2-8.25-8.25-8.3q-.7-.6-.675-1.6.025-1 .725-1.65.65-.7 1.575-.675.925.025 1.575.675l9.95 9.95q.3.3.5.725t.2.875q0 .5-.2.9t-.5.7l-9.9 9.9q-.65.65-1.6.625-.95-.025-1.6-.625Z" />
                    </svg>
                </button>
                <ul id="sub-2" class="w-full hidden flex-col border-y border-gray-300">
                    <li class="w-full">
                        <a href="{{ route('views.clients.index') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-primary hover:bg-opacity-60 focus:bg-opacity-60 {{ System::activeLink('views.clients.index') }}">
                            <div class="w-4 h-4 flex items-center justify-center"><span
                                    class="w-1.5 h-1.5 rounded-full bg-gray-900"></span></div>
                            <span class="text-sm font-medium">Clients</span>
                        </a>
                    </li>
                    <li class="w-full">
                        <a href="{{ route('views.contacts.index') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-primary hover:bg-opacity-60 focus:bg-opacity-60 {{ System::activeLink('views.contacts.index') }}">
                            <div class="w-4 h-4 flex items-center justify-center"><span
                                    class="w-1.5 h-1.5 rounded-full bg-gray-900"></span></div>
                            <span class="text-sm font-medium">Contacts</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="w-full flex flex-col">
                <button x-toggle="#sub-4, #sub-show-4, #sub-hide-4" x-property="hidden, flex"
                    class="w-full flex flex-wrap gap-2 justify-between items-center px-4 py-2 cursor-pointer outline-none text-gray-900">
                    <div class="w-max flex gap-2 flex-wrap items-center">
                        <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 96 960 960">
                            <path
                                d="M479.956 563q-76.826 0-124.391-48.065Q308 466.87 308 390.704q0-76.167 47.406-123.935Q402.812 219 479.637 219q76.826 0 125.094 47.656Q653 314.312 653 391.204q0 75.666-48.109 123.731Q556.781 563 479.956 563ZM229 926q-38.05 0-64.525-26.3Q138 873.4 138 835v-24.606q0-43.866 22.445-76.846Q182.891 700.568 220 684q68-32 131.854-47 63.854-15 127.731-15 65.877 0 128.646 16Q671 654 739 684q38.375 15.402 61.188 48.465Q823 765.528 823 810.394V835q0 38.4-26.769 64.7Q769.463 926 731 926H229Z" />
                        </svg>
                        <span class="text-sm font-black">Human resources</span>
                    </div>
                    <svg id="sub-show-4" class="hidden w-4 h-4 text-gray-900 pointer-events-none" fill="currentcolor"
                        viewBox="0 0 48 48">
                        <path d="M24 31.8 10.9 18.7 14.2 15.45 24 25.35 33.85 15.5 37.1 18.75Z"></path>
                    </svg>
                    <svg id="sub-hide-4" class="flex w-4 h-4 pointer-events-none" fill="currentcolor"
                        viewBox="0 0 48 48">
                        <path
                            d="M17.2 35.45q-.7-.75-.7-1.675t.7-1.575l8.2-8.25-8.25-8.3q-.7-.6-.675-1.6.025-1 .725-1.65.65-.7 1.575-.675.925.025 1.575.675l9.95 9.95q.3.3.5.725t.2.875q0 .5-.2.9t-.5.7l-9.9 9.9q-.65.65-1.6.625-.95-.025-1.6-.625Z" />
                    </svg>
                </button>
                <ul id="sub-4" class="w-full hidden flex-col border-y border-gray-300">
                    <li class="w-full">
                        <a href="{{ route('views.complaints.index') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-primary hover:bg-opacity-60 focus:bg-opacity-60 {{ System::activeLink('views.complaints.index') }}">
                            <div class="w-4 h-4 flex items-center justify-center"><span
                                    class="w-1.5 h-1.5 rounded-full bg-gray-900"></span></div>
                            <span class="text-sm font-medium">Complaints</span>
                        </a>
                    </li>
                    <li class="w-full">
                        <a href="{{ route('views.contracts.index') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-primary hover:bg-opacity-60 focus:bg-opacity-60 {{ System::activeLink('views.contracts.index') }}">
                            <div class="w-4 h-4 flex items-center justify-center"><span
                                    class="w-1.5 h-1.5 rounded-full bg-gray-900"></span></div>
                            <span class="text-sm font-medium">Contracts</span>
                        </a>
                    </li>
                    <li class="w-full">
                        <a href="{{ route('views.employees.index') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-primary hover:bg-opacity-60 focus:bg-opacity-60 {{ System::activeLink('views.employees.index') }}">
                            <div class="w-4 h-4 flex items-center justify-center"><span
                                    class="w-1.5 h-1.5 rounded-full bg-gray-900"></span></div>
                            <span class="text-sm font-medium">Employees</span>
                        </a>
                    </li>
                    <li class="w-full">
                        <a href="{{ route('views.insurances.index') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-primary hover:bg-opacity-60 focus:bg-opacity-60 {{ System::activeLink('views.insurances.index') }}">
                            <div class="w-4 h-4 flex items-center justify-center"><span
                                    class="w-1.5 h-1.5 rounded-full bg-gray-900"></span></div>
                            <span class="text-sm font-medium">Insurances</span>
                        </a>
                    </li>
                    <li class="w-full">
                        <a href="{{ route('views.leaves.index') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-primary hover:bg-opacity-60 focus:bg-opacity-60 {{ System::activeLink('views.leaves.index') }}">
                            <div class="w-4 h-4 flex items-center justify-center"><span
                                    class="w-1.5 h-1.5 rounded-full bg-gray-900"></span></div>
                            <span class="text-sm font-medium">Leaves</span>
                        </a>
                    </li>
                    <li class="w-full">
                        <a href="{{ route('views.policies.index') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-primary hover:bg-opacity-60 focus:bg-opacity-60 {{ System::activeLink('views.policies.index') }}">
                            <div class="w-4 h-4 flex items-center justify-center"><span
                                    class="w-1.5 h-1.5 rounded-full bg-gray-900"></span></div>
                            <span class="text-sm font-medium">Policies</span>
                        </a>
                    </li>
                    <li class="w-full">
                        <a href="{{ route('views.reviews.index') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-primary hover:bg-opacity-60 focus:bg-opacity-60 {{ System::activeLink('views.reviews.index') }}">
                            <div class="w-4 h-4 flex items-center justify-center"><span
                                    class="w-1.5 h-1.5 rounded-full bg-gray-900"></span></div>
                            <span class="text-sm font-medium">Reviews</span>
                        </a>
                    </li>
                    <li class="w-full">
                        <a href="{{ route('views.terminations.index') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-primary hover:bg-opacity-60 focus:bg-opacity-60 {{ System::activeLink('views.terminations.index') }}">
                            <div class="w-4 h-4 flex items-center justify-center"><span
                                    class="w-1.5 h-1.5 rounded-full bg-gray-900"></span></div>
                            <span class="text-sm font-medium">Terminations</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="w-full flex flex-col">
                <button x-toggle="#sub-5, #sub-show-5, #sub-hide-5" x-property="hidden, flex"
                    class="w-full flex flex-wrap gap-2 justify-between items-center px-4 py-2 cursor-pointer outline-none text-gray-900">
                    <div class="w-max flex gap-2 flex-wrap items-center">
                        <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 96 960 960">
                            <path
                                d="M271 450h146q9.4 0 16.7-6.813 7.3-6.813 7.3-17.234 0-10.42-7.3-17.186Q426.4 402 417 402H271q-10.4 0-17.2 6.813-6.8 6.813-6.8 17.234 0 10.42 6.8 17.186Q260.6 450 271 450Zm279 337h151q9.4 0 16.7-6.78 7.3-6.78 7.3-17.15 0-8.937-7.3-16.503Q710.4 739 701 739H550q-10.4 0-17.2 7.313-6.8 7.313-6.8 17.234 0 9.92 6.8 16.686Q539.6 787 550 787Zm0-107h151q9.4 0 16.7-6.813 7.3-6.813 7.3-17.234 0-9.42-7.3-16.686Q710.4 632 701 632H550q-10.4 0-17.2 7.313-6.8 7.313-6.8 17.234 0 9.92 6.8 16.686Q539.6 680 550 680ZM344.047 822q9.42 0 16.686-6.8Q368 808.4 368 798v-64h64q9.4 0 16.7-6.813 7.3-6.813 7.3-17.234 0-9.42-7.3-16.686Q441.4 686 432 686h-64v-64q0-9.4-7.313-16.7-7.313-7.3-17.234-7.3-9.92 0-16.686 7.3Q320 612.6 320 622v64h-64q-10.4 0-17.2 7.313-6.8 7.313-6.8 17.234 0 9.92 6.8 16.686Q245.6 734 256 734h64v64q0 10.4 6.813 17.2 6.813 6.8 17.234 6.8Zm200.239-313.5q6.285 7.5 16.545 7.5 10.26 0 18.169-7l44-44 44 44q5.75 6 15.739 6.5 9.988.5 18.261-7.5 6-6.545 6.5-16.17.5-9.624-6.5-17.83l-44-44 45-44q5-4.75 5.5-15.239.5-10.488-6.5-18.761-8.273-7-18.5-7t-16.5 7l-43 44-45-44.889Q572.25 345 561.554 345q-10.697 0-17.125 7Q537 360.273 537 370.5t7 16.5l44 43-44 44q-7 7-7 17.5t7.286 17ZM190 957q-37.175 0-64.088-26.912Q99 903.175 99 866V286q0-37.588 26.912-64.794Q152.825 194 190 194h580q37.588 0 64.794 27.206Q862 248.412 862 286v580q0 37.175-27.206 64.088Q807.588 957 770 957H190Z" />
                        </svg>
                        <span class="text-sm font-black">Financial services</span>
                    </div>
                    <svg id="sub-show-5" class="hidden w-4 h-4 text-gray-900 pointer-events-none" fill="currentcolor"
                        viewBox="0 0 48 48">
                        <path d="M24 31.8 10.9 18.7 14.2 15.45 24 25.35 33.85 15.5 37.1 18.75Z"></path>
                    </svg>
                    <svg id="sub-hide-5" class="flex w-4 h-4 pointer-events-none" fill="currentcolor"
                        viewBox="0 0 48 48">
                        <path
                            d="M17.2 35.45q-.7-.75-.7-1.675t.7-1.575l8.2-8.25-8.25-8.3q-.7-.6-.675-1.6.025-1 .725-1.65.65-.7 1.575-.675.925.025 1.575.675l9.95 9.95q.3.3.5.725t.2.875q0 .5-.2.9t-.5.7l-9.9 9.9q-.65.65-1.6.625-.95-.025-1.6-.625Z" />
                    </svg>
                </button>
                <ul id="sub-5" class="w-full hidden flex-col border-y border-gray-300">
                    <li class="w-full">
                        <a href="{{ route('views.accounts.index') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-primary hover:bg-opacity-60 focus:bg-opacity-60 {{ System::activeLink('views.accounts.index') }}">
                            <div class="w-4 h-4 flex items-center justify-center"><span
                                    class="w-1.5 h-1.5 rounded-full bg-gray-900"></span></div>
                            <span class="text-sm font-medium">Accounts</span>
                        </a>
                    </li>
                    <li class="w-full">
                        <a href="{{ route('views.expenses.index') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-primary hover:bg-opacity-60 focus:bg-opacity-60 {{ System::activeLink('views.expenses.index') }}">
                            <div class="w-4 h-4 flex items-center justify-center"><span
                                    class="w-1.5 h-1.5 rounded-full bg-gray-900"></span></div>
                            <span class="text-sm font-medium">Expenses</span>
                        </a>
                    </li>
                    <li class="w-full">
                        <a href="{{ route('test') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-primary hover:bg-opacity-60 focus:bg-opacity-60 {{ System::activeLink('test') }} bg-red-500 bg-opacity-10">
                            <div class="w-4 h-4 flex items-center justify-center"><span
                                    class="w-1.5 h-1.5 rounded-full bg-gray-900"></span></div>
                            <span class="text-sm font-medium">Invoices</span>
                        </a>
                    </li>
                    <li class="w-full">
                        <a href="{{ route('test') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-primary hover:bg-opacity-60 focus:bg-opacity-60 {{ System::activeLink('test') }} bg-red-500 bg-opacity-10">
                            <div class="w-4 h-4 flex items-center justify-center"><span
                                    class="w-1.5 h-1.5 rounded-full bg-gray-900"></span></div>
                            <span class="text-sm font-medium">Payments</span>
                        </a>
                    </li>
                    <li class="w-full">
                        <a href="{{ route('test') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-primary hover:bg-opacity-60 focus:bg-opacity-60 {{ System::activeLink('test') }} bg-red-500 bg-opacity-10">
                            <div class="w-4 h-4 flex items-center justify-center"><span
                                    class="w-1.5 h-1.5 rounded-full bg-gray-900"></span></div>
                            <span class="text-sm font-medium">Transactions</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</aside>
