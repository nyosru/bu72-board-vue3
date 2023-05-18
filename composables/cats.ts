import { useState } from "#app";
import { ref } from "vue";

const loadCats = async () => {
  const config = useRuntimeConfig();
  const { data: loadedCats } = await useFetch(
    `${config.public.apiBase}/api/posts`
  );
  return await loadedCats.value.data;
};

// const isMyValueEmpty = computed(() => {
//     return var.trim() === '';
//   });

const listCats = ref({});

export const getCats = async () => {
  try {
    if (listCats.value !== null && listCats.value.length > 0) {
      console.log("0077 каталоги уже есть", listCats.value);
      return listCats.value;
    } else {
      // }
      console.log("007711 каталоги новенькое");
      listCats.value = await loadCats();
      // console.log("useCats", 32, dataCats.length, dataCats);
      return await listCats.value;
    }
  } catch (error) {
    console.error(888);
    listCats.value = await loadCats();
    return await listCats.value;
  }
};

// export function useB () {
const useCats = async () => {
  //   const res = useState("cats");
  //   if (res.value.length > 0) {
  //     console.log(0, "useCats", res);
  //     return res;
  //   }

  let dataCats = {};
  //   dataCats = useState("cats");

  //   if ( dataCats != 'no' ){
  //     console.log(778899, dataCats);
  //     console.log(778899, dataCats.value);
  //     return dataCats
  //   }else{
  //     console.log(778899111);
  //   }

  dataCats = await loadCats();
  console.log("useCats", 32, dataCats.length, dataCats);

  return await useState("cats", () => dataCats);
};

export { useCats };

// function useB () {
//   return 'b'
// }

// function _useC () {
//   return 'c'
// }

// export const useD = () => {
//   return 'd'
// }

// export { useB, _useC as useC }

// export default function () {
//   return useState('foo', () => 'bar')
// }
