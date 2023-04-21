<template>
    <button
        class="text-green-700 dark:text-gray-200 h-12 w-12 rounded-full grid place-items-center bg-gray-100 dark:bg-slate-800">
        <i v-if="!$page.props.auth" class="fa-solid fa-user"></i>
        <img class="rounded-full" width="80"
            :src="`https://ui-avatars.com/api/?background=228B22&color=fff&name=${$page.props.auth.user.name}`" alt="">
    </button>
</template>