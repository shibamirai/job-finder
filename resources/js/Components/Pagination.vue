<script setup>
  defineProps({
    'prev_page_url': String,
    'next_page_url': String,
    'from': Number,
    'to': Number,
    'total': Number,
    'links': Array
  })
</script>

<template>
  <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
    <div class="flex justify-between flex-1 sm:hidden">
      <Component
        :is="prev_page_url ? 'Link' : 'span'"
        :href="prev_page_url"
        class="relative inline-flex items-center px-4 py-2 text-sm font-medium bg-white border border-gray-300 leading-5 rounded-md"
        :class="{
          'text-gray-500 cursor-default' : !prev_page_url,
          ' hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150' : prev_page_url
        }"
      >&laquo; 前へ</Component>
      <Component
        :is="next_page_url ? 'Link' : 'span'"
        :href="next_page_url"
        class="relative inline-flex items-center px-4 py-2 text-sm font-medium bg-white border border-gray-300 leading-5 rounded-md"
        :class="{
          'text-gray-500 cursor-default' : !next_page_url,
          'text-gray-700 hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150' : next_page_url
        }"
      >次へ &raquo;</Component>
    </div>
    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700 leading-5">
          Showing
          <span class="font-medium">{{ from }}</span>
          to
          <span class="font-medium">{{ to }}</span>
          of
          <span class="font-medium">{{ total }}</span>
          results
        </p>
      </div>
      <div>
        <span class="relative z-0 inline-flex shadow-sm rounded-md">
          <Component
            :is="prev_page_url ? 'Link' : 'span'"
            :href="prev_page_url"
            class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5"
            :class="{
              'cursor-default' : !prev_page_url,
              'hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150' : prev_page_url
            }"
          >
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
          </Component>

          <template v-for="(link, index) in links">
            <Component
              v-if="index != 0 && index != links.length - 1"
              :is="link.active ? 'span' : 'Link'"
              :href="link.url"
              v-html="link.label"
              class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5"
              :class="{
                'cursor-default' : !link.url,
                'hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150' : link.url,
              }"
            />
          </template>

          <Component
            :is="next_page_url ? 'Link' : 'span'"
            :href="next_page_url"
            class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5"
            :class="{
              'cursor-default' : !next_page_url,
              'hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150' : next_page_url
            }"
          >
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
          </Component>
        </span>
      </div>
    </div>
  </nav>
</template>
