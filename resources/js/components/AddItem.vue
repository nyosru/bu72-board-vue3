<template>
  <div>
    Добавить обьявление
    <br />
    user_id {{ user_id }}
    <br />
    <br />

    <div class="container-fluid">
      <div class="row" v-if="1 == 1 || !resultAdd">
        <div class="col-12">
          <!-- <br /> -->
          <!-- 'status_order' => 'required', // enum('buy','sell','arenda') COLLATE
              utf8mb4_unicode_ci NOT NULL COMMENT 'какой тип обьявления', -->
          <br />
          <select class="form-control" v-model="status_order" required >
            <option value="">Выберите тип обьявления</option>
            <option value="sell">Продаю</option>
            <option value="buy">Хочу купить</option>
            <option value="free">Отдам бесплатно</option>
            <option value="arenda">Сдаю в аренду</option>
            <option value="arenda_search">Хочу взять в аренду</option>
          </select>
        </div>

        <!--
        <div class="col-12">
          cat1 {{ cat1 }} <br />
          cat2 {{ cat2 }} <br />
          cat3 {{ cat3 }} <br />
          cat4 {{ cat4 }} <br />
          cat5 {{ cat5 }} <br />
          cat6 {{ cat6 }} <br />
          cat7 {{ cat7 }} <br />
      </div> -->

        <div class="col-12 select_catalog">
          Выберите каталог
          <!-- cat1list {{ cat1list }} -->

          <select
            class="form-control"
            v-model="cat1"
            v-if="cat1list && cat1list.length"
            @change="clearCats(2)"
            required
          >
            <option value="">Выберите подходящую категорию обьявления</option>
            <option v-for="c in cat1list" :key="c.id" :value="c.id">
              {{ c.name }}
            </option>
          </select>

          <!-- cat2list {{ cat2list }} -->

          <div v-if="cat2list && cat2list.length">
            <select class="form-control" v-model="cat2" @change="clearCats(3)">
              <option value="">Выберите подходящую категорию обьявления</option>
              <option v-for="c in cat2list" :key="c.id" :value="c.id">
                {{ c.name }}
              </option>
            </select>
            <transition name="fade">
              <div v-if="cat3list && cat3list.length">
                <select class="form-control" v-model="cat3" @change="clearCats(4)">
                  <option value="">Выберите подходящую категорию обьявления</option>
                  <option v-for="c in cat3list" :key="c.id" :value="c.id">
                    {{ c.name }}
                  </option>
                </select>
                <transition name="fade">
                  <div v-if="cat4list && cat4list.length">
                    <select class="form-control" v-model="cat4">
                      <option value="">Выберите подходящую категорию обьявления</option>
                      <option v-for="c in cat4list" :key="c.id" :value="c.id">
                        {{ c.name }}
                      </option>
                    </select>
                    <transition name="fade">
                      <div v-if="cat5list && cat5list.length">
                        <select class="form-control" v-model="cat5">
                          <option value="">
                            Выберите подходящую категорию обьявления
                          </option>
                          <option v-for="c in cat5list" :key="c.id" :value="c.id">
                            {{ c.name }}
                          </option>
                        </select>
                        <transition name="fade">
                          <div v-if="cat6list && cat6list.length">
                            <select class="form-control" v-model="cat6">
                              <option value="">
                                Выберите подходящую категорию обьявления
                              </option>
                              <option v-for="c in cat6list" :key="c.id" :value="c.id">
                                {{ c.name }}
                              </option>
                            </select>
                            <transition name="fade">
                              <div v-if="cat7list && cat7list.length">
                                <select class="form-control" v-model="cat7">
                                  <option value="">
                                    Выберите подходящую категорию обьявления
                                  </option>
                                  <option v-for="c in cat7list" :key="c.id" :value="c.id">
                                    {{ c.name }}
                                  </option>
                                </select>
                              </div>
                            </transition>
                          </div>
                        </transition>
                      </div>
                    </transition>
                  </div>
                </transition>
              </div>
            </transition>
          </div>
        </div>

        <!-- selected_cat_id {{ selected_cat_id }} -->

        <transition name="fade">
          <div class="col-12" v-if="selected_cat_id">
            name
            <br />
            <input type="text" class="form-control" v-model="name" required />
            <br />
            opis
            <br />
            <textarea class="form-control" v-model="opis"></textarea>
            <br />
            price
            <br />
            <input
              type="number"
              min="0"
              max="9999999"
              step="0.1"
              class="form-control"
              v-model.number="price"
              required
            />

            <div v-for="(file, key) in files" :key="key" class="file-listing">
              {{ file.name }}
              <a class="color-red remove-file" @click.prevent="removeFile(key)">Remove</a>
            </div>

            <br />
            <br />

            <br clear="all" />
            <br clear="all" />

            <label>
              Добавить фото
              <input
                type="file"
                id="files"
                ref="files"
                multiple
                @change="handleFilesUpload()"
              />
            </label>

            <br clear="all" />
            <br clear="all" />

            <button @click="addFiles()">Добавить фото</button>

            <br clear="all" />
            <br clear="all" />

            <button type="submit" @click="submitFiles()">Submit</button>

            <div
              class="alert alert-danger"
              v-if="error && error.message && error.message.length"
            >
              {{ error.message }}
            </div>

            <small> error {{ error }} </small>
          </div>
        </transition>
      </div>

      <!-- если добавлено -->
      <div class="row" v-else>
        <div class="col-12 alert alert-success">Добавлено!</div>
      </div>
    </div>

    resultAdd {{ resultAdd }}
  </div>
</template>

<script>
import { ref, watchEffect, onMounted } from "vue";

// import Item from "./ShowItemsItem.vue";
// import fdd from './../modules/VitrinItems.ts'
import Catalogs from "./../modules/Catalogs.ts";
// import VitrinItems from "./../modules/VitrinItems.ts";
import AddItem from "./AddItem.ts";
import axios from "axios";

import dayjs from "dayjs";

import User from "./../modules/User.ts";

export default {
  // const getUserRepositories = async () => {
  //     repositories = await fetchUserRepositories(props.user)
  //   }

  //   components: {
  //     Item,
  //   },

  setup(props) {
    // const { items } = VitrinItems();
    const {
      catalogs,
      filtrCatsShow,
      cat1,
      cat1list,
      cat2,
      cat2list,
      cat3,
      cat3list,
      cat4,
      cat4list,
      cat5,
      cat5list,
      cat6,
      cat6list,
      cat7,
      cat7list,
      selected_cat_id,
      clearCats,
    } = Catalogs();

    // const error1 = ref(false);

    const { error, resultAdd } = AddItem();

    watchEffect(() => {
      filtrCatsShow(
        cat1.value,
        cat2.value,
        cat3.value,
        cat4.value,
        cat5.value,
        cat6.value,
        cat7.value
      );
    });

    onMounted(() => {
      window.scrollTo(0, 0);
    });

    // const resultAdd = ref(false);

    const {
      // getCatalogs,
      user_id,
    } = User();

    return {
      user_id,
      resultAdd,
      selected_cat_id,

      catalogs,
      error,
      cat1,
      cat1list,
      cat2,
      cat2list,
      cat3,
      cat3list,
      cat4,
      cat4list,
      cat5,
      cat5list,
      cat6,
      cat6list,
      cat7,
      cat7list,
      //   error1,
      //   erro
      //   items,
      clearCats,
    };
  },

  data() {
    return {
      name: "",
      opis: "",
      price: "",
      status_order: "",
      showItemOpis: false,
      files: [],
      //   error1: false,
      //   cat1: "",
      //   cat2: "",
      //   cat3: "",
      //   cat4: "",
      //   cat5: "",
      //   cat6: "",
      //   result: "",
    };
  },

  methods: {
    addFiles() {
      this.$refs.files.click();
    },

    async submitFiles() {
      console.log("this.files", this.files);
      console.log("this.files2", this.files[0]);

      let formData = new FormData();

      formData.append("name", this.name ?? "");
      formData.append("opis", this.opis ?? "");
      formData.append("price", this.price ?? "");

      formData.append("date", dayjs().format('YYYY-MM-DD') );

      formData.append("cat_id", this.selected_cat_id ?? "");
      formData.append("status_order", this.status_order ?? "");

      for (var i = 0; i < this.files.length; i++) {
        let file = this.files[i];
        formData.append("files" + i, file);
      }

      console.log("formData", formData);

      console.log("this.error1", this.error1);

      const {
        // getCatalogs,
        user_id,
      } = User();

      formData.append("autor_id", user_id.value ?? 0);
      console.log("formData", formData);
      try {
        const res = await axios
          .post("/api/select-files", formData, {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          })
          .then(function () {
            console.log("SUCCESS!!");
            const { resultAdd } = AddItem();
            resultAdd.value = true;
            window.scrollTo(0, 0);
          })
          .catch(function (err) {
            if (err && err.response && err.response.length) {
              const { error } = AddItem();
              error.value = err.response.data ?? {};
            }
          });
      } catch (error) {
        console.log("error", error.message);
      }
    },

    handleFilesUpload() {
      let uploadedFiles = this.$refs.files.files;
      for (var i = 0; i < uploadedFiles.length; i++) {
        this.files.push(uploadedFiles[i]);
      }
    },

    removeFile(key) {
      this.files.splice(key, 1);
    },
  },
};
</script>

<style lang="scss">
.select_catalog {
  select {
    margin-bottom: 5px;
  }
  div {
    padding-left: 15px;
  }
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
