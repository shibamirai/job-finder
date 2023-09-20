<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

import { ref } from 'vue';

const open = ref(false);
</script>

<template>
  <nav class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <Link :href="route('index')">
                        <ApplicationLogo class="w-36" />
                    </Link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <NavLink :href="route('statistics')" :active="$page.component === 'Statistics/Index'">
                        統計情報
                    </NavLink >
                </div>

                <template v-if="$page.props.auth.user">
                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <NavLink :href="route('job-finders.index')" :active="$page.component === 'JobFinders/Index'">
                            就職者一覧
                        </NavLink >
                    </div>
                    <!-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <NavLink :href="route('job-finders.create')" :active="$page.component === 'JobFinders/Create'">
                            情報登録
                        </NavLink >
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <NavLink :href="route('occupations.index')" :active="$page.component === 'Occupations/Index'">
                            職種編集
                        </NavLink >
                    </div> -->
                </template>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <template v-if="$page.props.auth.user">
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>{{ $page.props.auth.user.name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </template>

                        <template #content>
                            <!-- Authentication -->
                            <DropdownLink :href="route('profile.edit')">{{ $t('Profile') }}</DropdownLink>
                            <DropdownLink :href="route('logout')" method="post" as="button">
                                {{ $t('Logout') }}
                            </DropdownLink>
                        </template>
                    </Dropdown>
                </template>
                <template v-else>
                    <NavLink :href="route('login')">
                        {{ $t('Login') }}
                    </NavLink >
                </template>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <ResponsiveNavLink :href="route('statistics')" :active="$page.component === 'Statistics/Index'">
                統計情報
            </ResponsiveNavLink>
        </div>
        <template v-if="$page.props.auth.user">
            <div class="pt-2 pb-3 space-y-1">
                <ResponsiveNavLink :href="route('job-finders.index')" :active="$page.component === 'JobFinders/Index'">
                    就職者一覧
                </ResponsiveNavLink>
                <!-- <ResponsiveNavLink :href="route('job-finders.create')" :active="$page.component === 'JobFinders/Create'">
                    情報登録
                </ResponsiveNavLink>
                <ResponsiveNavLink :href="route('occupations.index')" :active="$page.component === 'Occupations/Index'">
                    職種編集
                </ResponsiveNavLink> -->
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ $page.props.auth.user.name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Authentication -->
                    <ResponsiveNavLink :href="route('profile.edit')">{{ $t('Profile') }}</ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                        {{ $t('Logout') }}
                    </ResponsiveNavLink>
                </div>
            </div>
        </template>
        <template v-else>
            <ResponsiveNavLink :href="route('login')" class="text-right">
                {{ $t('Login') }}
            </ResponsiveNavLink>
        </template>
    </div>
  </nav>
</template>