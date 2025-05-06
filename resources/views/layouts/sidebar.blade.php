<aside
        :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
        class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 dark:border-gray-800 dark:bg-black lg:static lg:translate-x-0"
>
    <!-- SIDEBAR HEADER -->
    <div
            :class="sidebarToggle ? 'justify-center' : 'justify-between'"
            class="flex items-center gap-2 pt-8 sidebar-header pb-7"
    >
        <a href="{{url('sign-in')}}">
      <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
        <img class="dark:hidden" src="{{ asset('../images/logo/logo-light.svg') }}" alt="Logo"/>
        <img
                class="hidden dark:block"
                src="{{ asset('../images/logo/logo-dark.svg') }}"
                alt="Logo"
        />
      </span>

            <img
                    class="logo-icon"
                    :class="sidebarToggle ? 'lg:block' : 'hidden'"
                    src="{{url('../images/logo/icon-light.svg')}}"
                    alt="Logo"
            />
        </a>
    </div>
    <!-- SIDEBAR HEADER -->

    <div
            class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar"
    >
        <!-- Sidebar Menu -->
        @if(Auth::user()->role == "admin")
            <nav x-data="{selected: $persist('Dashboard')}">
                <!-- Menu Group -->
                <div>
                    <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
              <span
                      class="menu-group-title"
                      :class="sidebarToggle ? 'lg:hidden' : ''"
              >
                ADMIN MENU
              </span>

                        <svg
                                :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                                class="mx-auto fill-current menu-group-icon"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                                    fill=""
                            />
                        </svg>
                    </h3>

                    <ul class="flex flex-col gap-4 mb-6">
                        <!-- Menu Item Dashboard -->
                        <li>
                            <a
                                href="{{ url('admin/dashboard') }}"
                                @click="selected = (selected === 'Dashboard' ? '':'Dashboard')"
                                class="menu-item group"
                                :class="(selected === 'Dashboard' || '{{ Request::segment(2) }}' === 'dashboard') ? 'menu-item-active' : 'menu-item-inactive'"
                            >
                                <svg
                                    :class="(selected === 'Dashboard' || '{{ Request::segment(2) }}' === 'dashboard') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V8.99998C3.25 10.2426 4.25736 11.25 5.5 11.25H9C10.2426 11.25 11.25 10.2426 11.25 8.99998V5.5C11.25 4.25736 10.2426 3.25 9 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H9C9.41421 4.75 9.75 5.08579 9.75 5.5V8.99998C9.75 9.41419 9.41421 9.74998 9 9.74998H5.5C5.08579 9.74998 4.75 9.41419 4.75 8.99998V5.5ZM5.5 12.75C4.25736 12.75 3.25 13.7574 3.25 15V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H9C10.2426 20.75 11.25 19.7427 11.25 18.5V15C11.25 13.7574 10.2426 12.75 9 12.75H5.5ZM4.75 15C4.75 14.5858 5.08579 14.25 5.5 14.25H9C9.41421 14.25 9.75 14.5858 9.75 15V18.5C9.75 18.9142 9.41421 19.25 9 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V15ZM12.75 5.5C12.75 4.25736 13.7574 3.25 15 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V8.99998C20.75 10.2426 19.7426 11.25 18.5 11.25H15C13.7574 11.25 12.75 10.2426 12.75 8.99998V5.5ZM15 4.75C14.5858 4.75 14.25 5.08579 14.25 5.5V8.99998C14.25 9.41419 14.5858 9.74998 15 9.74998H18.5C18.9142 9.74998 19.25 9.41419 19.25 8.99998V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H15ZM15 12.75C13.7574 12.75 12.75 13.7574 12.75 15V18.5C12.75 19.7426 13.7574 20.75 15 20.75H18.5C19.7426 20.75 20.75 19.7427 20.75 18.5V15C20.75 13.7574 19.7426 12.75 18.5 12.75H15ZM14.25 15C14.25 14.5858 14.5858 14.25 15 14.25H18.5C18.9142 14.25 19.25 14.5858 19.25 15V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15C14.5858 19.25 14.25 18.9142 14.25 18.5V15Z"
                                        fill=""
                                    />
                                </svg>

                                <span
                                    class="menu-item-text"
                                    :class="sidebarToggle ? 'lg:hidden' : ''"
                                >
            Dashboard
        </span>
                            </a>
                        </li>

                        <!-- Menu Item Users -->
                        <li>
                            <a
                                href="#"
                                @click.prevent="selected = (selected === 'Users' ? '':'Users')"
                                class="menu-item group"
                                :class="selected === 'Users' ? 'menu-item-active' : 'menu-item-inactive'"
                            >
                                <svg
                                    :class="selected === 'Users' ? 'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <!-- SVG Path for Users Icon -->
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M12 3.5C7.30558 3.5 3.5 7.30558 3.5 12C3.5 14.1526 4.3002 16.1184 5.61936 17.616C6.17279 15.3096 8.24852 13.5955 10.7246 13.5955H13.2746C15.7509 13.5955 17.8268 15.31 18.38 17.6167C19.6996 16.119 20.5 14.153 20.5 12C20.5 7.30558 16.6944 3.5 12 3.5ZM17.0246 18.8566V18.8455C17.0246 16.7744 15.3457 15.0955 13.2746 15.0955H10.7246C8.65354 15.0955 6.97461 16.7744 6.97461 18.8455V18.856C8.38223 19.8895 10.1198 20.5 12 20.5C13.8798 20.5 15.6171 19.8898 17.0246 18.8566ZM2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM11.9991 7.25C10.8847 7.25 9.98126 8.15342 9.98126 9.26784C9.98126 10.3823 10.8847 11.2857 11.9991 11.2857C13.1135 11.2857 14.0169 10.3823 14.0169 9.26784C14.0169 8.15342 13.1135 7.25 11.9991 7.25ZM8.48126 9.26784C8.48126 7.32499 10.0563 5.75 11.9991 5.75C13.9419 5.75 15.5169 7.32499 15.5169 9.26784C15.5169 11.2107 13.9419 12.7857 11.9991 12.7857C10.0563 12.7857 8.48126 11.2107 8.48126 9.26784Z"
                                        fill=""
                                    />
                                </svg>

                                <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
            Users
        </span>

                                <svg
                                    class="menu-item-arrow"
                                    :class="[(selected === 'Users') ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : '' ]"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 20 20"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585"
                                        stroke=""
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </a>

                            <!-- Dropdown Menu Start -->
                            <div
                                class="overflow-hidden transform translate"
                                :class="selected === 'Users' ? 'block' : 'hidden'"
                            >
                                <ul
                                    :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                    class="flex flex-col gap-1 mt-2 menu-dropdown pl-9"
                                >
                                    <li>
                                        <a
                                            href="{{ url('admin/users/admin') }}"
                                            class="menu-dropdown-item group"
                                            :class="(page === 'manageAdmins' || '{{ Request::segment(3) }}' === 'admin') ? 'menu-item-active' : 'menu-item-inactive'"
                                        >
                                            Manage Admins
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ url('admin/users/teacher') }}"
                                            class="menu-dropdown-item group"
                                            :class="(page === 'manageTeachers' || '{{ Request::segment(3) }}' === 'teacher') ? 'menu-item-active' : 'menu-item-inactive'"
                                        >
                                            Manage Teachers
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ url('admin/users/student') }}"
                                            class="menu-dropdown-item group"
                                            :class="(page === 'manageStudents' || '{{ Request::segment(3) }}' === 'student') ? 'menu-item-active' : 'menu-item-inactive'"
                                        >
                                            Manage Students
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Dropdown Menu End -->
                        </li>

                        <!-- Menu Item Majors -->
                        <li>
                            <a
                                href="{{ url('admin/majors') }}"
                                class="menu-item group"
                                :class="(selected === 'Majors' || '{{ Request::segment(2) }}' === 'majors') ? 'menu-item-active' : 'menu-item-inactive'"
                            >
                                <svg
                                    :class="(selected === 'Majors' || '{{ Request::segment(2) }}' === 'majors') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <!-- SVG Path for Majors Icon -->
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H18.5001C19.7427 20.75 20.7501 19.7426 20.7501 18.5V5.5C20.7501 4.25736 19.7427 3.25 18.5001 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H18.5001C18.9143 4.75 19.2501 5.08579 19.2501 5.5V18.5C19.2501 18.9142 18.9143 19.25 18.5001 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V5.5ZM6.25005 9.7143C6.25005 9.30008 6.58583 8.9643 7.00005 8.9643L17 8.96429C17.4143 8.96429 17.75 9.30008 17.75 9.71429C17.75 10.1285 17.4143 10.4643 17 10.4643L7.00005 10.4643C6.58583 10.4643 6.25005 10.1285 6.25005 9.7143ZM6.25005 14.2857C6.25005 13.8715 6.58583 13.5357 7.00005 13.5357H17C17.4143 13.5357 17.75 13.8715 17.75 14.2857C17.75 14.6999 17.4143 15.0357 17 15.0357H7.00005C6.58583 15.0357 6.25005 14.6999 6.25005 14.2857Z"
                                        fill=""
                                    />
                                </svg>

                                <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
            Majors
        </span>
                            </a>
                        </li>

                        <!-- Menu Item Subjects -->
                        <li>
                            <a
                                href="{{ url('admin/subjects') }}"
                                class="menu-item group"
                                :class="(selected === 'Subjects' || '{{ Request::segment(2) }}' === 'subjects') ? 'menu-item-active' : 'menu-item-inactive'"
                            >
                                <svg
                                    :class="(selected === 'Subjects' || '{{ Request::segment(2) }}' === 'subjects') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <!-- SVG Path for Subjects Icon -->
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H18.5001C19.7427 20.75 20.7501 19.7426 20.7501 18.5V5.5C20.7501 4.25736 19.7427 3.25 18.5001 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H18.5001C18.9143 4.75 19.2501 5.08579 19.2501 5.5V18.5C19.2501 18.9142 18.9143 19.25 18.5001 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V5.5ZM6.25005 9.7143C6.25005 9.30008 6.58583 8.9643 7.00005 8.9643L17 8.96429C17.4143 8.96429 17.75 9.30008 17.75 9.71429C17.75 10.1285 17.4143 10.4643 17 10.4643L7.00005 10.4643C6.58583 10.4643 6.25005 10.1285 6.25005 9.7143ZM6.25005 14.2857C6.25005 13.8715 6.58583 13.5357 7.00005 13.5357H17C17.4143 13.5357 17.75 13.8715 17.75 14.2857C17.75 14.6999 17.4143 15.0357 17 15.0357H7.00005C6.58583 15.0357 6.25005 14.6999 6.25005 14.2857Z"
                                        fill=""
                                    />
                                </svg>

                                <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
            Subjects
        </span>
                            </a>
                        </li>

                        <!-- Menu Item Classrooms -->
                        <li>
                            <a
                                href="{{ url('admin/classrooms') }}"
                                class="menu-item group"
                                :class="(selected === 'Classrooms' || '{{ Request::segment(2) }}' === 'classrooms') ? 'menu-item-active' : 'menu-item-inactive'"
                            >
                                <svg
                                    :class="(selected === 'Classrooms' || '{{ Request::segment(2) }}' === 'classrooms') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <!-- SVG Path for Classrooms Icon -->
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H18.5001C19.7427 20.75 20.7501 19.7426 20.7501 18.5V5.5C20.7501 4.25736 19.7427 3.25 18.5001 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H18.5001C18.9143 4.75 19.2501 5.08579 19.2501 5.5V18.5C19.2501 18.9142 18.9143 19.25 18.5001 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V5.5ZM6.25005 9.7143C6.25005 9.30008 6.58583 8.9643 7.00005 8.9643L17 8.96429C17.4143 8.96429 17.75 9.30008 17.75 9.71429C17.75 10.1285 17.4143 10.4643 17 10.4643L7.00005 10.4643C6.58583 10.4643 6.25005 10.1285 6.25005 9.7143ZM6.25005 14.2857C6.25005 13.8715 6.58583 13.5357 7.00005 13.5357H17C17.4143 13.5357 17.75 13.8715 17.75 14.2857C17.75 14.6999 17.4143 15.0357 17 15.0357H7.00005C6.58583 15.0357 6.25005 14.6999 6.25005 14.2857Z"
                                        fill=""
                                    />
                                </svg>

                                <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
            Classrooms
        </span>
                            </a>
                        </li>

                        <!-- Menu Item Upload CSV -->
                        <li>
                            <a
                                href="#"
                                @click.prevent="selected = (selected === 'Upload CSV' ? '':'Upload CSV')"
                                class="menu-item group"
                                :class="selected === 'Upload CSV' ? 'menu-item-active' : 'menu-item-inactive'"
                            >
                                <svg
                                    :class="(selected === 'Upload CSV') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M7.41 8.29492L12 3.70492L16.59 8.29492L18 6.88492L12 0.884918L6 6.88492L7.41 8.29492Z"
                                        fill=""
                                    />
                                    <path
                                        d="M18 14.8849V10.8849H16V14.8849H6V10.8849H4V14.8849C4 16.9849 5.79 18.8849 8 18.8849H16C18.21 18.8849 20 16.9849 20 14.8849V10.8849H18V14.8849Z"
                                        fill=""
                                    />
                                </svg>

                                <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
            Global Upload and Assignments
        </span>

                                <svg
                                    class="menu-item-arrow"
                                    :class="[(selected === 'Upload CSV') ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : '' ]"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 20 20"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585"
                                        stroke=""
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </a>

                            <!-- Dropdown Menu Start -->
                            <div
                                class="overflow-hidden transform translate"
                                :class="selected === 'Upload CSV' ? 'block' : 'hidden'"
                            >
                                <ul
                                    :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                    class="flex flex-col gap-1 mt-2 menu-dropdown pl-9"
                                >
                                    <li>
                                        <a
                                            href="{{ url('admin/upload/students') }}"
                                            class="menu-dropdown-item group"
                                            :class="(page === 'Upload CSV' || '{{ Request::segment(3) }}' === 'students') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'"
                                        >
                                            Upload Students
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ url('admin/assign/subject-teacher-assignments') }}"
                                            class="menu-dropdown-item group"
                                            :class="(page === 'Upload CSV' || '{{ Request::segment(3) }}' === 'subject-teacher-assignments') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'"
                                        >
                                            Assign Teachers with Subjects
                                        </a>
                                    </li>


                                </ul>
                            </div>
                            <!-- Dropdown Menu End -->
                        </li>


                        <!-- Menu Item Assignments -->
                        <li>
                            <a
                                href="#"
                                @click.prevent="selected = (selected === 'Assignments' ? '':'Assignments')"
                                class="menu-item group"
                                :class="selected === 'Assignments' ? 'menu-item-active' : 'menu-item-inactive'"
                            >
                                <svg
                                    :class="(selected === 'Assignments') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M14 2.75C14 2.33579 14.3358 2 14.75 2C15.1642 2 15.5 2.33579 15.5 2.75V5.73291L17.75 5.73291H19C19.4142 5.73291 19.75 6.0687 19.75 6.48291C19.75 6.89712 19.4142 7.23291 19 7.23291H18.5L18.5 12.2329C18.5 15.5691 15.9866 18.3183 12.75 18.6901V21.25C12.75 21.6642 12.4142 22 12 22C11.5858 22 11.25 21.6642 11.25 21.25V18.6901C8.01342 18.3183 5.5 15.5691 5.5 12.2329L5.5 7.23291H5C4.58579 7.23291 4.25 6.89712 4.25 6.48291C4.25 6.0687 4.58579 5.73291 5 5.73291L6.25 5.73291L8.5 5.73291L8.5 2.75C8.5 2.33579 8.83579 2 9.25 2C9.66421 2 10 2.33579 10 2.75L10 5.73291L14 5.73291V2.75ZM7 7.23291L7 12.2329C7 14.9943 9.23858 17.2329 12 17.2329C14.7614 17.2329 17 14.9943 17 12.2329L17 7.23291L7 7.23291Z"
                                        fill=""
                                    />
                                </svg>

                                <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
            Single Upload and Assignments
        </span>

                                <svg
                                    class="menu-item-arrow"
                                    :class="[(selected === 'Assignments') ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : '' ]"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 20 20"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585"
                                        stroke=""
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </a>

                            <!-- Dropdown Menu Start -->
                            <div
                                class="overflow-hidden transform translate"
                                :class="selected === 'Assignments' ? 'block' : 'hidden'"
                            >
                                <ul
                                    :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                    class="flex flex-col gap-1 mt-2 menu-dropdown pl-9"
                                >
                                    <li>
                                        <a
                                            href="{{ url('admin/assignments/subject') }}"
                                            class="menu-dropdown-item group"
                                            :class="(page === 'Assignments' || '{{ Request::segment(3) }}' === 'subject') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'"
                                        >
                                            Assign Subjects
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ url('admin/assignments/teacher') }}"
                                            class="menu-dropdown-item group"
                                            :class="(page === 'Assignments' || '{{ Request::segment(3) }}' === 'teacher') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'"
                                        >
                                            Assign Teachers
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ url('admin/assignments/student') }}"
                                            class="menu-dropdown-item group"
                                            :class="(page === 'Assignments' || '{{ Request::segment(3) }}' === 'student') ? 'menu-item-active' : 'menu-item-inactive'"
                                        >
                                            Assign Students
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Dropdown Menu End -->
                        </li>

                        <!-- Menu Item Grades -->
                    </ul>
                </div>
                <!-- Others Group -->
                <div>
                    <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
          <span
              class="menu-group-title"
              :class="sidebarToggle ? 'lg:hidden' : ''"
          >
            others
          </span>

                        <svg
                            :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                            class="menu-group-icon mx-auto fill-current"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                                fill=""
                            />
                        </svg>
                    </h3>

                    <ul class="mb-6 flex flex-col gap-4">
                        <!-- Menu Item Settings -->
                        <li>
                            <a
                                href="{{ url('admin/settings/link-classroom-to-school-year') }}"
                                @click="selected = (selected === 'Settings' ? '' : 'Settings')"
                                class="menu-item group"
                                :class="(selected === 'Settings' || '{{ Request::segment(2) }}' === 'settings') ? 'menu-item-active' : 'menu-item-inactive'"
                            >
                                <svg
                                    :class="(selected === 'Settings' || '{{ Request::segment(2) }}' === 'settings') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M10.4858 3.5L13.5182 3.5C13.9233 3.5 14.2518 3.82851 14.2518 4.23377C14.2518 5.9529 16.1129 7.02795 17.602 6.1682C17.9528 5.96567 18.4014 6.08586 18.6039 6.43667L20.1203 9.0631C20.3229 9.41407 20.2027 9.86286 19.8517 10.0655C18.3625 10.9253 18.3625 13.0747 19.8517 13.9345C20.2026 14.1372 20.3229 14.5859 20.1203 14.9369L18.6039 17.5634C18.4013 17.9142 17.9528 18.0344 17.602 17.8318C16.1129 16.9721 14.2518 18.0471 14.2518 19.7663C14.2518 20.1715 13.9233 20.5 13.5182 20.5H10.4858C10.0804 20.5 9.75182 20.1714 9.75182 19.766C9.75182 18.0461 7.88983 16.9717 6.40067 17.8314C6.04945 18.0342 5.60037 17.9139 5.39767 17.5628L3.88167 14.937C3.67903 14.586 3.79928 14.1372 4.15026 13.9346C5.63949 13.0748 5.63946 10.9253 4.15025 10.0655C3.79926 9.86282 3.67901 9.41401 3.88165 9.06303L5.39764 6.43725C5.60034 6.08617 6.04943 5.96581 6.40065 6.16858C7.88982 7.02836 9.75182 5.9539 9.75182 4.23399C9.75182 3.82862 10.0804 3.5 10.4858 3.5ZM13.5182 2L10.4858 2C9.25201 2 8.25182 3.00019 8.25182 4.23399C8.25182 4.79884 7.64013 5.15215 7.15065 4.86955C6.08213 4.25263 4.71559 4.61859 4.0986 5.68725L2.58261 8.31303C1.96575 9.38146 2.33183 10.7477 3.40025 11.3645C3.88948 11.647 3.88947 12.3531 3.40026 12.6355C2.33184 13.2524 1.96578 14.6186 2.58263 15.687L4.09863 18.3128C4.71562 19.3814 6.08215 19.7474 7.15067 19.1305C7.64015 18.8479 8.25182 19.2012 8.25182 19.766C8.25182 20.9998 9.25201 22 10.4858 22H13.5182C14.7519 22 15.7518 20.9998 15.7518 19.7663C15.7518 19.2015 16.3632 18.8487 16.852 19.1309C17.9202 19.7476 19.2862 19.3816 19.9029 18.3134L21.4193 15.6869C22.0361 14.6185 21.6701 13.2523 20.6017 12.6355C20.1125 12.3531 20.1125 11.647 20.6017 11.3645C21.6701 10.7477 22.0362 9.38152 21.4193 8.3131L19.903 5.68667C19.2862 4.61842 17.9202 4.25241 16.852 4.86917C16.3632 5.15138 15.7518 4.79856 15.7518 4.23377C15.7518 3.00024 14.7519 2 13.5182 2ZM9.6659 11.9999C9.6659 10.7103 10.7113 9.66493 12.0009 9.66493C13.2905 9.66493 14.3359 10.7103 14.3359 11.9999C14.3359 13.2895 13.2905 14.3349 12.0009 14.3349C10.7113 14.3349 9.6659 13.2895 9.6659 11.9999ZM12.0009 8.16493C9.88289 8.16493 8.1659 9.88191 8.1659 11.9999C8.1659 14.1179 9.88289 15.8349 12.0009 15.8349C14.1189 15.8349 15.8359 14.1179 15.8359 11.9999C15.8359 9.88191 14.1189 8.16493 12.0009 8.16493Z"
                                        fill=""
                                    />
                                </svg>

                                <span
                                    class="menu-item-text"
                                    :class="sidebarToggle ? 'lg:hidden' : ''"
                                >
                Settings
            </span>
                            </a>
                        </li>

                        <!-- Menu Item Support -->
                        <li>
                            <a
                                href="{{ url('admin/documentation') }}"
                                @click="selected = (selected === 'Documentation' ? '' : 'Documentation')"
                                class="menu-item group"
                                :class="(selected === 'Documentation' || '{{ Request::segment(2) }}' === 'documentation') ? 'menu-item-active' : 'menu-item-inactive'"
                            >
                                <svg
                                    :class="(selected === 'Documentation' || '{{ Request::segment(2) }}' === 'documentation') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M3.5 12C3.5 7.30558 7.30558 3.5 12 3.5C16.6944 3.5 20.5 7.30558 20.5 12C20.5 16.6944 16.6944 20.5 12 20.5C7.30558 20.5 3.5 16.6944 3.5 12ZM12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2ZM11.0991 7.52507C11.0991 8.02213 11.5021 8.42507 11.9991 8.42507H12.0001C12.4972 8.42507 12.9001 8.02213 12.9001 7.52507C12.9001 7.02802 12.4972 6.62507 12.0001 6.62507H11.9991C11.5021 6.62507 11.0991 7.02802 11.0991 7.52507ZM12.0001 17.3714C11.5859 17.3714 11.2501 17.0356 11.2501 16.6214V10.9449C11.2501 10.5307 11.5859 10.1949 12.0001 10.1949C12.4143 10.1949 12.7501 10.5307 12.7501 10.9449V16.6214C12.7501 17.0356 12.4143 17.3714 12.0001 17.3714Z"
                                        fill=""
                                    />
                                </svg>

                                <span
                                    class="menu-item-text"
                                    :class="sidebarToggle ? 'lg:hidden' : ''"
                                >
                Documentation
            </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        @elseif(Auth::user()->role == "teacher")
            <nav x-data="{selected: $persist('Dashboard')}">
                <!-- Menu Group -->
                <div>
                    <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
          <span
              class="menu-group-title"
              :class="sidebarToggle ? 'lg:hidden' : ''"
          >
            Teacher MENU
          </span>

                        <svg
                            :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                            class="mx-auto fill-current menu-group-icon"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                                fill=""
                            />
                        </svg>
                    </h3>

                    <ul class="flex flex-col gap-4 mb-6">
                        <!-- Menu Item Dashboard -->
                        <li>
                            <a
                                href="{{ url('teacher/dashboard') }}"
                                @click="selected = (selected === 'dashboard' ? '' : 'Dashboard')"
                                class="menu-item group"
                                :class="(selected === 'Dashboard' || '{{ Request::segment(2) }}' === 'dashboard') ? 'menu-item-active' : 'menu-item-inactive'"
                            >
                                <svg
                                    :class="(selected === 'Dashboard' || '{{ Request::segment(2) }}' === 'dashboard') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V8.99998C3.25 10.2426 4.25736 11.25 5.5 11.25H9C10.2426 11.25 11.25 10.2426 11.25 8.99998V5.5C11.25 4.25736 10.2426 3.25 9 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H9C9.41421 4.75 9.75 5.08579 9.75 5.5V8.99998C9.75 9.41419 9.41421 9.74998 9 9.74998H5.5C5.08579 9.74998 4.75 9.41419 4.75 8.99998V5.5ZM5.5 12.75C4.25736 12.75 3.25 13.7574 3.25 15V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H9C10.2426 20.75 11.25 19.7427 11.25 18.5V15C11.25 13.7574 10.2426 12.75 9 12.75H5.5ZM4.75 15C4.75 14.5858 5.08579 14.25 5.5 14.25H9C9.41421 14.25 9.75 14.5858 9.75 15V18.5C9.75 18.9142 9.41421 19.25 9 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V15ZM12.75 5.5C12.75 4.25736 13.7574 3.25 15 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V8.99998C20.75 10.2426 19.7426 11.25 18.5 11.25H15C13.7574 11.25 12.75 10.2426 12.75 8.99998V5.5ZM15 4.75C14.5858 4.75 14.25 5.08579 14.25 5.5V8.99998C14.25 9.41419 14.5858 9.74998 15 9.74998H18.5C18.9142 9.74998 19.25 9.41419 19.25 8.99998V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H15ZM15 12.75C13.7574 12.75 12.75 13.7574 12.75 15V18.5C12.75 19.7426 13.7574 20.75 15 20.75H18.5C19.7426 20.75 20.75 19.7427 20.75 18.5V15C20.75 13.7574 19.7426 12.75 18.5 12.75H15ZM14.25 15C14.25 14.5858 14.5858 14.25 15 14.25H18.5C18.9142 14.25 19.25 14.5858 19.25 15V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15C14.5858 19.25 14.25 18.9142 14.25 18.5V15Z"
                                        fill=""
                                    />
                                </svg>

                                <span
                                    class="menu-item-text"
                                    :class="sidebarToggle ? 'lg:hidden' : ''"
                                >
            Dashboard
        </span>
                            </a>
                        </li>

                        <!-- Menu Item Calendar -->
                        <li>
                            <a
                                href="{{ url('teacher/calendar') }}"
                                @click="selected = (selected === 'Calendar' ? '' : 'Calendar')"
                                class="menu-item group"
                                :class="(selected === 'Calendar' || '{{ Request::segment(2) }}' === 'calendar') ? 'menu-item-active' : 'menu-item-inactive'"
                            >
                                <svg
                                    :class="(selected === 'Calendar' || '{{ Request::segment(2) }}' === 'calendar') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M8 2C8.41421 2 8.75 2.33579 8.75 2.75V3.75H15.25V2.75C15.25 2.33579 15.5858 2 16 2C16.4142 2 16.75 2.33579 16.75 2.75V3.75H18.5C19.7426 3.75 20.75 4.75736 20.75 6V9V19C20.75 20.2426 19.7426 21.25 18.5 21.25H5.5C4.25736 21.25 3.25 20.2426 3.25 19V9V6C3.25 4.75736 4.25736 3.75 5.5 3.75H7.25V2.75C7.25 2.33579 7.58579 2 8 2ZM8 5.25H5.5C5.08579 5.25 4.75 5.58579 4.75 6V8.25H19.25V6C19.25 5.58579 18.9142 5.25 18.5 5.25H16H8ZM19.25 9.75H4.75V19C4.75 19.4142 5.08579 19.75 5.5 19.75H18.5C18.9142 19.75 19.25 19.4142 19.25 19V9.75Z"
                                        fill=""
                                    />
                                </svg>

                                <span
                                    class="menu-item-text"
                                    :class="sidebarToggle ? 'lg:hidden' : ''"
                                >
            Calendar
        </span>
                            </a>
                        </li>

                    </ul>
                </div>
            </nav>
        @elseif(Auth::user()->role == "student")
            <nav x-data="{selected: $persist('Dashboard')}">
                <!-- Menu Group -->
                <div>
                    <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
          <span
              class="menu-group-title"
              :class="sidebarToggle ? 'lg:hidden' : ''"
          >
            STUDENT MENU
          </span>

                        <svg
                            :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                            class="mx-auto fill-current menu-group-icon"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                                fill=""
                            />
                        </svg>
                    </h3>

                    <ul class="flex flex-col gap-4 mb-6">
                        <!-- Menu Item Dashboard -->
                        <li>
                            <a
                                href="{{ url('student/dashboard') }}"
                                @click="selected = (selected === 'Dashboard' ? '' : 'Dashboard')"
                                class="menu-item group"
                                :class="(selected === 'Dashboard' || '{{ Request::segment(2) }}' === 'dashboard') ? 'menu-item-active' : 'menu-item-inactive'"
                            >
                                <svg
                                    :class="(selected === 'Dashboard' || '{{ Request::segment(2) }}' === 'dashboard') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V8.99998C3.25 10.2426 4.25736 11.25 5.5 11.25H9C10.2426 11.25 11.25 10.2426 11.25 8.99998V5.5C11.25 4.25736 10.2426 3.25 9 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H9C9.41421 4.75 9.75 5.08579 9.75 5.5V8.99998C9.75 9.41419 9.41421 9.74998 9 9.74998H5.5C5.08579 9.74998 4.75 9.41419 4.75 8.99998V5.5ZM5.5 12.75C4.25736 12.75 3.25 13.7574 3.25 15V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H9C10.2426 20.75 11.25 19.7427 11.25 18.5V15C11.25 13.7574 10.2426 12.75 9 12.75H5.5ZM4.75 15C4.75 14.5858 5.08579 14.25 5.5 14.25H9C9.41421 14.25 9.75 14.5858 9.75 15V18.5C9.75 18.9142 9.41421 19.25 9 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V15ZM12.75 5.5C12.75 4.25736 13.7574 3.25 15 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V8.99998C20.75 10.2426 19.7426 11.25 18.5 11.25H15C13.7574 11.25 12.75 10.2426 12.75 8.99998V5.5ZM15 4.75C14.5858 4.75 14.25 5.08579 14.25 5.5V8.99998C14.25 9.41419 14.5858 9.74998 15 9.74998H18.5C18.9142 9.74998 19.25 9.41419 19.25 8.99998V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H15ZM15 12.75C13.7574 12.75 12.75 13.7574 12.75 15V18.5C12.75 19.7426 13.7574 20.75 15 20.75H18.5C19.7426 20.75 20.75 19.7427 20.75 18.5V15C20.75 13.7574 19.7426 12.75 18.5 12.75H15ZM14.25 15C14.25 14.5858 14.5858 14.25 15 14.25H18.5C18.9142 14.25 19.25 14.5858 19.25 15V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15C14.5858 19.25 14.25 18.9142 14.25 18.5V15Z"
                                        fill=""
                                    />
                                </svg>

                                <span
                                    class="menu-item-text"
                                    :class="sidebarToggle ? 'lg:hidden' : ''"
                                >
            Dashboard
        </span>
                            </a>
                        </li>

                        <!-- Menu Item Calendar -->
                        <li>
                            <a
                                href="{{ url('student/calendar') }}"
                                @click="selected = (selected === 'Calendar' ? '' : 'Calendar')"
                                class="menu-item group"
                                :class="(selected === 'Calendar' || '{{ Request::segment(2) }}' === 'calendar') ? 'menu-item-active' : 'menu-item-inactive'"
                            >
                                <svg
                                    :class="(selected === 'Calendar' || '{{ Request::segment(2) }}' === 'calendar') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M8 2C8.41421 2 8.75 2.33579 8.75 2.75V3.75H15.25V2.75C15.25 2.33579 15.5858 2 16 2C16.4142 2 16.75 2.33579 16.75 2.75V3.75H18.5C19.7426 3.75 20.75 4.75736 20.75 6V9V19C20.75 20.2426 19.7426 21.25 18.5 21.25H5.5C4.25736 21.25 3.25 20.2426 3.25 19V9V6C3.25 4.75736 4.25736 3.75 5.5 3.75H7.25V2.75C7.25 2.33579 7.58579 2 8 2ZM8 5.25H5.5C5.08579 5.25 4.75 5.58579 4.75 6V8.25H19.25V6C19.25 5.58579 18.9142 5.25 18.5 5.25H16H8ZM19.25 9.75H4.75V19C4.75 19.4142 5.08579 19.75 5.5 19.75H18.5C18.9142 19.75 19.25 19.4142 19.25 19V9.75Z"
                                        fill=""
                                    />
                                </svg>

                                <span
                                    class="menu-item-text"
                                    :class="sidebarToggle ? 'lg:hidden' : ''"
                                >
            Calendar
        </span>
                            </a>
                        </li>

                    </ul>
                </div>
            </nav>
        @endif
        <!-- Sidebar Menu -->

        <!-- Promo Box -->
        @if(Auth::user()->role == "student" || Auth::user()->role == "teacher")
        <div
                :class="sidebarToggle ? 'lg:hidden' : ''"
                class="absolute bottom-0 mx-auto mb-0 w-full max-w-60 rounded-2xl bg-gray-50 px-4 py-5 text-center dark:bg-white/[0.03]"
        >
            <h3 class="mb-2 font-semibold text-gray-900 dark:text-white">
                ENSAM GradeHouse
            </h3>
            <p class="mb-4 text-gray-500 text-theme-sm dark:text-gray-400">
                Build by ❤️ by Aymane ISSAMI
            </p>
            <a href="http://linkedin.com/in/issamiaymane"
               target="_blank"
               rel="nofollow"
               class="flex items-center justify-center p-3 font-medium text-white rounded-lg bg-brand-500 text-theme-sm hover:bg-brand-600">
                Let's Connect on LinkedIn
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path d="M20.5 2h-17A1.5 1.5 0 0 0 2 3.5v17A1.5 1.5 0 0 0 3.5 22h17a1.5 1.5 0 0 0 1.5-1.5v-17A1.5 1.5 0 0 0 20.5 2zM8 19H5v-9h3zM6.5 8.25A1.75 1.75 0 1 1 8.3 6.5a1.78 1.78 0 0 1-1.8 1.75zM19 19h-3v-4.74c0-1.42-.6-1.93-1.38-1.93A1.74 1.74 0 0 0 13 14.19V19h-3v-9h2.9v1.3a3.11 3.11 0 0 1 2.7-1.4c1.55 0 3.36.86 3.36 3.66z"/>
                </svg>
            </a>

        </div>
        @endif
        <!-- Promo Box -->
    </div>
</aside>
