<template>
  <div class="app-layout">
    <AppHeader />
    <main>
      <slot />
    </main>
    <AppFooter />
  </div>
</template>

<style scoped>
.app-layout {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  background: var(--black);
  color: var(--white);
}

main {
  flex: 1;
}
</style>
