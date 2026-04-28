<script setup>
import { computed, ref } from 'vue';
import PersonCard from '../Organisms/PersonCard.vue';

const people = ref([
    { githubUsername: 'dkuteda', alt: 'David Kutej', isStaff: false },
    { githubUsername: 'octocat', alt: 'The Octocat', isStaff: false },
    { githubUsername: 'torvalds', alt: 'Linus Torvalds', isStaff: false },
    { githubUsername: 'gaearon', alt: 'Dan Abramov', isStaff: false },
])

const applicants = computed(() => people.value.filter(person => !person.isStaff))
const staffMembers = computed(() => people.value.filter(person => person.isStaff))

const addToStaff = (username) => {
    const person = people.value.find(p => p.githubUsername === username);
    if (person) person.isStaff = true;
}

const removeFromStaff = (username) => {
    const person = people.value.find(p => p.githubUsername === username);
    if (person) person.isStaff = false;
}

</script>

<template>
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

