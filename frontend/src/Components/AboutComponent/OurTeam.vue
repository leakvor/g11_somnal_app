<template>
  <section class="our-team">
    <div class="team-header">
      <h3 class="team-subtitle">Our Team</h3>
      <h2 class="team-title">Meet Our Professional Team</h2>
      <h5 class="team-description">Our team is dedicated to treating every customer like royalty.</h5>
    </div>
    <div class="team-cards">
      <div class="team-card" v-for="(member, index) in teamMembers" :key="member.name">
        <img :src="getImagePath(member.image)" :alt="member.name" class="team-member-img" />
        <h5 :class="['team-member-name', index % 2 === 0 ? 'style-one' : 'style-two']">{{ member.name }}</h5><br>
        <p :class="['team-member-role', index % 2 === 0 ? 'style-one' : 'style-two']">{{ member.role }}</p>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'OurTeam',
  data() {
    return {
      teamMembers: [
        { name: 'Panha Pourn', role: 'Worker', image: 'panha.jpg' },
        { name: 'Ngut Tiv', role: 'CEO', image: 'tiv.jpg' },
        { name: 'Choan Chorn', role: 'Worker', image: 'chorn.jpg' }
      ]
    };
  },
  methods: {
    getImagePath(image) {
      return new URL(`../../assets/${image}`, import.meta.url).href;
    }
  }
};
</script>

<style scoped>
.our-team {
  margin-top: 80px;
  padding: 30px 0 100px 0;
  border-radius: 10px;
  text-align: center;
}

.team-header {
  margin-bottom: 50px;
}

.team-subtitle {
  color: #057931;
  font-size: 24px;
  font-weight: bold;
}

.team-title {
  margin-top: 10px;
  font-size: 30px;
  font-weight: bold;
}

.team-description {
  margin-top: 10px;
  font-size: 18px;
  color: #888;
}

.team-cards {
  display: flex;
  justify-content: center;
  gap: 24px;
  flex-wrap: wrap;
}

.team-card {
  background: #fff;
  border: 1px solid #dfe7dc;
  border-radius: 8px;
  padding: 20px;
  text-align: center;
  width: 250px;
  box-shadow: 0 8px 22px rgba(31, 41, 51, 0.09);
  transition: transform 0.3s, box-shadow 0.3s;
}

.team-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 32px rgba(31, 41, 51, 0.12);
}

.team-member-img {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  object-fit: cover;
  margin-bottom: 15px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.team-member-name {
  display: inline-block;
  padding: 5px 10px;
  border-radius: 5px;
  font-size: 15px;
}

.team-member-role {
  display: inline-block;
  padding: 5px 5px;
  border-radius: 5px;
  font-size: 10px;
}

.style-one {
  background: #177245;
  color: white;
  border-bottom: 0;
}

.style-two {
  background: #f59e0b;
  color: white;
  border-bottom: 0;
}
</style>
