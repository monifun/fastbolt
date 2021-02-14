<template>
    <inertia-link
        :href="href"
        :class="classes"
        class="hover:text-indigo-600 transition ease-in-out duration-150"
    >
        <slot />
    </inertia-link>
</template>

<script>
    export default {
        name: "TextLink",
        props: ['href', 'classes'],
    };
</script>
