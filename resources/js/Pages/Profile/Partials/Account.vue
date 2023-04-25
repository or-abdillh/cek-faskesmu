<template>
    <section>
        <!-- header -->
        <section class="flex flex-col md:flex-row items-center gap-4 mb-12">
            <!-- avatar -->
            <section>
                <img class="rounded-full" width="60"
                    :src="`https://ui-avatars.com/api/?background=228B22&color=fff&name=${$page?.props?.auth?.user?.name}`"
                    alt="">
            </section>
            <!-- bio -->
            <section>
                <h1 class="text-2xl text-gray-700 mb-2">{{ $page.props.auth.user.name }}</h1>
                <section class="text-gray-600 flex flex-col md:flex-row gap-4 text-sm">
                    <!-- role -->
                    <span><i class="fa-solid fa-user-shield mr-1"></i>{{
                        $page.props.auth.user.roles[0].name }}</span>

                    <!-- last login at -->
                    <span>
                        <i class="fa-solid fa-stopwatch"></i>
                        Terakhir kali login pada
                        {{ new Date($page.props.auth.user.last_login_at).toLocaleDateString() }}
                        {{ new Date($page.props.auth.user.last_login_at).toLocaleTimeString() }}
                    </span>
                </section>
            </section>
        </section>

        <!-- main -->
        <main>
            <UpdateProfileInformationForm></UpdateProfileInformationForm>
        </main>
    </section>
</template>

<script setup>

import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue'

</script>