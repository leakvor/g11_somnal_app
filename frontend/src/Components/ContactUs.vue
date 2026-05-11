<template>
  <section class="contact-section">
    <div class="container">
      <div class="contact-card">
        <div>
          <p class="eyebrow">Contact</p>
          <h2>Need help with scrap pickup?</h2>
          <p class="summary">Reach the Somnal team for support, company questions, or pickup guidance.</p>
        </div>
        <div class="contact-actions">
          <a href="tel:012345678" class="btn btn-success">
            <i class="material-icons">call</i>
            Call
          </a>
          <a href="mailto:support@somnal.local" class="btn btn-outline-success">
            <i class="material-icons">mail</i>
            Email
          </a>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'ContactUs'
}
</script>

<style scoped>
.contact-section {
  padding: 48px 0 72px;
}

.contact-card {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 24px;
  padding: 28px;
  background: #fff;
  border: 1px solid #dfe7dc;
  border-radius: 8px;
  box-shadow: 0 12px 32px rgba(31, 41, 51, 0.08);
}

.eyebrow {
  margin-bottom: 8px;
  color: #177245;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0;
}

h2 {
  color: #1f2933;
  font-weight: 800;
}

.summary {
  margin-bottom: 0;
  color: #667085;
}

.contact-actions {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
}

.contact-actions .btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

@media (max-width: 768px) {
  .contact-card {
    align-items: flex-start;
    flex-direction: column;
  }
}
</style>
