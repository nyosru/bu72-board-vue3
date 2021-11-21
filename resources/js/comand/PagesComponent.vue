<template>
  <ul class="pagination pagination-sm">
      <li class="page-item" >Страницы:</li>
    <template v-for="i in page_kolvo" :key="i">
      <!-- <template v-if="!showThisPage(i, page_kolvo, showPagesAround)"> -->
        <li class="page-item" v-if="!showThisPage(i, page_kolvo, showPagesAround) && skip_page == 1">
        <!-- <li class="page-item" v-if="skip_page == 1"> -->
          <span class="page-link">...</span>
        </li>
      <!-- </template> -->
      <li class="page-item" v-else>
        <a
          href="#"
          class="page-link"
          :class="i == now_page ? 'bg-info' : ''"
          @click.prevent="now_page = i"
        >
          {{ i }}
        </a>
      </li>
    </template>
  </ul>
</template>

<script>
import pages from "./../modules/pages.ts";

export default {
  props: {
    itemsKolvo: {
      type: Number,
      required: true,
    },
    onPage: {
      type: Number,
      // required: true
      default: 20,
    },
    showPagesAround: {
      type: Number,
      default: 5,
    },
    // nowPage: {
    //   type: Number,
    //   // required: true
    //   default: 1,
    // },
  },

  data: () => ({
    skip_page: 0,
  }),

  setup(props) {

    const { now_page, onPage } = pages();

    // console.log("commis", "table pages", "setup");
    return {
        now_page, onPage
    };
  },

  // components: {
  // },

  methods: {
    // setLookPage(page) {
    //   console.log("кликнули новая страница " + page);
    //   // this.nowPage = page;
    //   this.$emit("actionClick", page);
    // },
    // показывать эту страницу или нет
    showThisPage(i, kolvo, around) {

      if (
        (i >= this.now_page - around && i <= this.now_page + around) ||
        i == kolvo ||
        i == 1
      ) {
        if (this.skip_page != 0) {
          this.skip_page = 0;
        }
        return true;
      } else {
        if (this.skip_page == 1) {
          this.skip_page = 2;
        } else if (this.skip_page == 0) {
          this.skip_page = 1;
        }

        return false;
      }
    },
  },

  computed: {
    page_kolvo() {
        // console.log( 'page_kolvo' , this.itemsKolvo , this.onPage );
      return Math.ceil(this.itemsKolvo / this.onPage);
    },
  },

  // mounted() {
  //     console.log("commis", "table", "mounted");
  // }
};
</script>

<style></style>
