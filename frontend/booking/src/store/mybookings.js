import axios from "axios";

const useMyBookings = async () => {
    try {
        const user_id = localStorage.getItem('user')
        const response = await axios('/my-bookings', {
        headers: {
                "Content-Type": "application/json",
            "Authorization": `Bearer ${user_id}`
            }
        })
        return response.data
    } catch (error) {
        return error.response ? error.response.data : error.message
    }
}

export default useMyBookings;