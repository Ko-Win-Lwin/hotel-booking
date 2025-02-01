import HomeView from './pages/HomeView.vue'
import LoginView from './pages/LoginView.vue'
import SignupView from './pages/SignupView.vue'
import BookingView from './pages/BookingView.vue'
import AdminView from './pages/AdminView.vue'
import MyBookings from './pages/MyBookings.vue'
import axios from 'axios'

const routes = [
  { path: '/', component: HomeView },

  {
    path: '/login',
    component: LoginView,
    beforeEnter: (to, from, next) => {
      if (localStorage.getItem('user')) {
        next('/bookings')
      }
      next()
    }
  },

  { path: '/signup', component: SignupView },

  {
    path: "/admin", 
    component: AdminView,
    beforeEnter: (to, from, next) => {
      if (!localStorage.getItem('user')) {
        next('/login')
      } else {
        next()
      }
    }
  },

  {
    path: '/my-bookings',
    component: MyBookings,
    beforeEnter: async (to, from, next) => {
      const user_id = localStorage.getItem('user');

      if (!user_id) {
        next('/login'); // Redirect to login if not logged in
      } else {
        try {
          const response = await axios.get("/bookings", {
            headers: {
              'Authorization': `Bearer ${user_id}`,
              'Content-Type': 'application/json',
            },
          });

          if (response.data.length > 0) {
            next(); // If the user has bookings, allow them to proceed
          } else {
            next('/booking'); // If the user has no bookings, redirect to the booking page
          }
        } catch (error) {
          console.error("Error fetching bookings", error.response ? error.response.data : error.message);
          next('/login'); // If fetching bookings fails, redirect to login
        }
      }
    }
  },

  {
    path: '/booking',
    component: BookingView,
    beforeEnter: async (to, from, next) => {
      const user_id = localStorage.getItem('user');

      if (!user_id) {
        next('/login'); // Redirect to login if not logged in
        return;
      }

      try {
        const response = await axios.get("/bookings", {
          headers: {
            'Authorization': `Bearer ${user_id}`,
            'Content-Type': 'application/json',
          },
        });

        if (response.data.length >= 1) {
          next('/my-bookings'); // If the user already has a booking, redirect to my-bookings
        } else {
          next(); // Otherwise, allow access to booking page
        }
      } catch (error) {
        console.error("Error fetching bookings", error.response ? error.response.data : error.message);
        next('/login'); // If fetching bookings fails, redirect to login
      }
    }
  }

]



export default routes;