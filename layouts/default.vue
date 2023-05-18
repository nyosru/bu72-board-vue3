<template>
    <div>
        <nav class="navbar navbar-expand-lg bg-dark mb-4" data-bs-theme="dark">
            <div class="container">
                <NuxtLink class="navbar-brand" to="/cat/0">Бу72.рф</NuxtLink>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul 
                    v-if="1==2"
                    class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <!-- <NuxtLink class="nav-link active" aria-current="page" to="/cats">Каталог</NuxtLink> -->
                            <NuxtLink class="nav-link active" aria-current="page" to="/cat/0">Каталог</NuxtLink>
                        </li>
                        <li class="nav-item">
                            <NuxtLink class="nav-link active" aria-current="page" to="/posts">Продают</NuxtLink>
                        </li>
                        <li class="nav-item">
                            <NuxtLink class="nav-link active" aria-current="page" to="/posts">Хотят купить</NuxtLink>
                        </li>
                        <li class="nav-item">
                            <NuxtLink class="nav-link active" aria-current="page" to="/posts">Сдают в аренду</NuxtLink>
                        </li>
                        <li class="nav-item">
                            <NuxtLink class="nav-link active" aria-current="page" to="/posts">Хотят взять в арренду</NuxtLink>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0" role="search">
                        <a href="https://php-cat.com" target="_blank" class="btn btn-success">php-cat.com</a>
                    </ul>
                </div>
            </div>
        </nav>

     
        <!--- render page -->
        <slot />

    </div>
</template>

<script setup>
console.log(7878);
</script>

<style>
body { background-color: white; font-family: 'Quicksand', sans-serif }

.type-color-sell {
  background-color: rgb(251, 255, 0);
  color: black;
}
.type-color-buy {
  background-color: #ff0000;
  color: white;
}
.type-color-renta {
  background-color: #1307ff;
  color: white;
}
.type-color-need_renta {
  background-color: #dd00ff;
  color: white;
}

</style>
