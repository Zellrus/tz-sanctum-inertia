<template>
  <div class="pagination_list">
    <button
        v-if="content.current_page > 1"
        @click="$emit('change_page', content.current_page - 1)"
        class="pagination_list_item previous_page"
    >
      <svg width="100%" height="100%" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
        <defs>
          <clipPath id="clip394_1414">
            <rect id="ArrowLeft" rx="100%" width="100%" height="100%" transform="translate(40.000000 40.000000) rotate(180.000000)" fill="white" fill-opacity="0"/>
          </clipPath>
        </defs>
        <rect id="ArrowLeft" rx="100%" width="100%" height="100%" transform="translate(40.000000 40.000000) rotate(180.000000)" fill-opacity="1.000000"/>
        <g clip-path="url(#clip394_1414)">
          <path id="Arrow" d="M8.62 21.5L14.54 27.42C15.13 28.01 15.13 28.95 14.54 29.54C13.95 30.13 13.01 30.13 12.42 29.54L3.93 21.06C3.34 20.46 3.34 19.53 3.93 18.93L12.42 10.45C13.01 9.86 13.95 9.86 14.54 10.45C15.13 11.04 15.13 11.98 14.54 12.57L8.62 18.5L35 18.5C35.84 18.5 36.5 19.16 36.5 20C36.5 20.84 35.84 21.5 35 21.5L8.62 21.5Z" fill="#929495" fill-opacity="1.000000" fill-rule="evenodd"/>
        </g>
      </svg>
    </button>


    <template v-for="(page, index) in pagesToShow" :key="page">
      <div
          class="pagination_list_item pagination_splitter"
          v-if="index > 0 && page - pagesToShow[index - 1] > 1"
      >
        <svg width="30" height="3" viewBox="0 0 33 3" fill="none">
          <path d="M1.5 1.5L31.5 1.5" stroke="var(--button-bg)" stroke-width="3" stroke-linecap="round"/>
        </svg>
      </div>

      <button
          class="pagination_list_item"
          :class="{ active: isCurrent(page) }"
          @click="$emit('change_page', page)"
          :disabled="isCurrent(page)"
      >
        {{ page }}
      </button>
    </template>

    <button
        v-if="content.current_page < content.last_page"
        @click="$emit('change_page', content.current_page + 1)"
        class="pagination_list_item next_page"
    >
      <svg width="100%" height="100%" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
        <defs>
          <clipPath id="clip394_1432">
            <rect id="ArrowRight" rx="100%" width="100%" height="100%" transform="translate(40.000000 40.000000) rotate(180.000000)" fill="white" fill-opacity="0"/>
          </clipPath>
        </defs>
        <rect id="ArrowRight" rx="100%"  width="100%" height="100%" transform="translate(40.000000 40.000000) rotate(180.000000)" fill="" fill-opacity="1.000000"/>
        <g clip-path="url(#clip394_1432)">
          <path id="Arrow" d="M31.37 18.5L25.45 12.57C24.86 11.98 24.86 11.04 25.45 10.45C26.04 9.86 26.98 9.86 27.57 10.45L36.06 18.93C36.65 19.53 36.65 20.46 36.06 21.06L27.57 29.54C26.98 30.13 26.04 30.13 25.45 29.54C24.86 28.95 24.86 28.01 25.45 27.42L31.37 21.5L5 21.5C4.15 21.5 3.5 20.84 3.5 20C3.5 19.16 4.15 18.5 5 18.5L31.37 18.5Z" fill="#929495" fill-opacity="1.000000" fill-rule="evenodd"/>
        </g>
      </svg>
    </button>
  </div>
</template>
<script>
export default {
  props: {
    content: {
      type: Object,
      required: true,
    }
  },
  computed: {
    currentPage() {
      return this.content.current_page;
    },
    lastPage() {
      return this.content.last_page;
    },
    firstPage() {
      return 1;
    },
    pagesToShow() {
      const pages = new Set();

      pages.add(this.firstPage);

      if (this.currentPage !== this.firstPage && this.currentPage !== this.lastPage) {
        pages.add(this.currentPage);
      }

      pages.add(this.lastPage);

      return Array.from(pages).sort((a, b) => a - b);
    }
  },
  methods: {
    isCurrent(page) {
      return this.content.current_page === page;
    }
  }
}
</script>
<style scoped>
button{
  all: unset;
}
.pagination_list{
    display: flex;
    gap:10px;
    list-style-type: none;
    cursor: pointer;
}
.pagination_list_item{
    min-width: 30px;
    height: 30px;
    border-radius: 20px;
    padding: 5px;
    background: var(--button-bg);
    font-family: Poppins, sans-serif;
    font-size: 20px;
    font-weight: 500;
    text-align: center;
    opacity: 0.8;
}
.pagination_splitter{
    background: unset;
    /* text-align: center; */
    padding: 0;
}
.pagination_list a{
    text-decoration: none;
}
.pagination_list_item:hover:not(.pagination_splitter), .pagination_list_item.next_page:hover {
    background: var(--button-bg-hover);
    /* color: white; */
}

html[dir="rtl"] .pagination_list_item.next_page, html[dir="rtl"] .pagination_list_item.previous_page{
  transform: scaleX(-1);
}

.pagination_list_item:active:not(.pagination_splitter) {
    /* background: rgb(80, 84, 85); */
    background: var(--button-bg);
}
.pagination_list_item:hover:not(.pagination_splitter) svg path {
    fill: currentColor
}
.active{
    background: var(--button-bg-hover);
    /* color:white */
    opacity: 1;
    font-weight: 600;
}


</style>