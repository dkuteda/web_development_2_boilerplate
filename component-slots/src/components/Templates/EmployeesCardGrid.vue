<script setup>
import { computed, ref } from 'vue';
import PersonCard from '../Organisms/PersonCard.vue';
import AppAlerts from '../Molecules/AppAlerts.vue';

const people = ref([
    { githubUsername: 'dkuteda', alt: 'David Kutej', isStaff: false },
    { githubUsername: 'octocat', alt: 'The Octocat', isStaff: false },
    { githubUsername: 'torvalds', alt: 'Linus Torvalds', isStaff: false },
    { githubUsername: 'gaearon', alt: 'Dan Abramov', isStaff: false },
])

// This is just an example of how you might manage state and actions in the EmployeesCardGrid component. In a real application, you would likely fetch this data from an API and handle state management more robustly, possibly using a state management library like Vuex or Pinia.
const alert = ref({
    show: false,
    type: 'info',
    message: ''
});

// Helper to trigger alerts
const showAlert = (type, message) => {
    alert.value = { show: true, type, message };
    
    // Auto-hide after 3 seconds
    setTimeout(() => {
        alert.value.show = false;
    }, 3000);
};

const applicants = computed(() => people.value.filter(person => !person.isStaff))
const staffMembers = computed(() => people.value.filter(person => person.isStaff))

const addToStaff = (username) => {
    const person = people.value.find(p => p.githubUsername === username);
    if (person) 
    {
        person.isStaff = true;
        showAlert('success', `${person.alt} hired successfully!`);
    }
    else {
        showAlert('error', `Could not find applicant with username: ${username}`);
    }
}

const removeFromStaff = (username) => {
    const person = people.value.find(p => p.githubUsername === username);
    if (person) {
        person.isStaff = false;
        showAlert('warning', `${person.alt} removed from staff.`);
    }
    else {
        showAlert('error', `Could not find staff member with username: ${username}`);
    }
}
</script>

<template>
    <div class="fixed top-4 right-4 z-50 w-80">
        <AppAlerts 
            v-if="alert.show" 
            :type="alert.type" 
            @closed="alert.show = false"
        >
            {{ alert.message }}
        </AppAlerts>
    </div>

    <section class="grid grid-cols-1 md:grid-cols-2 min-content gap-4">
        <PersonCard
            v-for="person in applicants"
            :key="person.githubUsername"

            :githubUsername="person.githubUsername"
            :alt="person.alt"
            :isStaff="person.isStaff"
            @hire="addToStaff"
        />
    </section>

    <h2 class="text-2xl font-bold mt-8">Your Staff</h2>
    <section class="grid grid-cols-1 md:grid-cols-2 min-content gap-4">
        <PersonCard
            v-for="person in staffMembers"
            :key="person.githubUsername"
            
            :githubUsername="person.githubUsername"
            :alt="person.alt"
            :isStaff="person.isStaff"
            @fire="removeFromStaff"
        />
    </section>
</template>