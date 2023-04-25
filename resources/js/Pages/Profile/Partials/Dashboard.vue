<template>
    <section>
        <h1 class="text-2xl text-gray-700 mb-3">Halo, {{ $page.props.auth.user.name }}</h1>
        <p class="text-gray-600 mb-16">Anda terdaftar sebagai administrator dari fasilitas kesehatan {{
            props.dashboard?.facility?.name }}
            sejak {{ new Date(props.dashboard?.facility?.created_at).toLocaleDateString() }}
        </p>

        <!-- tabs -->
        <section class="flex gap-3 mb-8">
            <template v-for="tab in tabs" :key="tab.id">
                <button @click="active = tab.name"
                    :class="active === tab.name ? 'border-green-800 text-green-800' : 'text-gray-500 border-gray-100'"
                    class="duration-300 border-b-2 px-3 pb-2">{{
                        tab.name }}</button>
            </template>
        </section>

        <!-- tab view  -->
        <main>
            <!-- Ringkasan -->
            <DashboardResume :resume="props.dashboard?.resume" v-if="active === 'Ringkasan'"></DashboardResume>
            <!-- Profile -->
            <DashboardProfile :locations="props.dashboard?.locations" :profile="props.dashboard?.facility"
                v-if="active === 'Profile'"></DashboardProfile>
            <!-- Services -->
            <DashboardService :services="props.dashboard?.services" v-if="active === 'Layanan'"></DashboardService>
            <!-- Drugs -->
            <DashboardDrug :drugs="props.dashboard?.drugs" v-if="active === 'Obatan'"></DashboardDrug>
            <!-- Reset -->
            <DashboardReset v-if="active === 'Reset'"></DashboardReset>
        </main>
    </section>
</template>

<script setup>

import { ref } from 'vue'
import DashboardResume from '@/Pages/Profile/Partials/DashboardResume.vue'
import DashboardProfile from '@/Pages/Profile/Partials/DashboardProfile.vue'
import DashboardService from '@/Pages/Profile/Partials/DashboardService.vue'
import DashboardDrug from '@/Pages/Profile/Partials/DashboardDrug.vue'
import DashboardReset from '@/Pages/Profile/Partials/DashboardReset.vue'

const props = defineProps({
    dashboard: Object
})

const active = ref('Ringkasan')

const tabs = [
    { id: 0, name: 'Ringkasan' },
    { id: 1, name: 'Profile' },
    { id: 2, name: 'Layanan' },
    { id: 3, name: 'Obatan' },
    { id: 4, name: 'Reset' },
]

</script>