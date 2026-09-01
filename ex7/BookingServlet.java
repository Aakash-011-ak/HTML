import java.io.*;
import java.sql.*;
import javax.servlet.*;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.*;

@WebServlet("/BookingServlet")
public class BookingServlet extends HttpServlet {
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        response.setContentType("text/html");
        PrintWriter out = response.getWriter();

        String userName  = request.getParameter("userName");
        String eventName = request.getParameter("eventName");
        int numTickets   = Integer.parseInt(request.getParameter("numTickets"));

        Connection con = null;
        try {
            Class.forName("com.mysql.jdbc.Driver");
            
            // Connecting to the 'servlet' database
            con = DriverManager.getConnection(
                "jdbc:mysql://localhost:3306/servlet?useSSL=false"
              + "&allowPublicKeyRetrieval=true&serverTimezone=UTC",
                "root", "mysql"); // Replace "root123" with your MySQL password

            PreparedStatement ps = con.prepareStatement(
                "INSERT INTO tickets (user_name, event_name, num_tickets) VALUES (?,?,?)");
            ps.setString(1, userName);
            ps.setString(2, eventName);
            ps.setInt(3, numTickets);

            int rows = ps.executeUpdate();

            if (rows > 0) {
                out.println("<h3>Booking successful for " + userName + "!</h3>");

                Statement stmt = con.createStatement();
                ResultSet rs = stmt.executeQuery("SELECT * FROM tickets");

                out.println("<table border='1' cellpadding='5'>");
                out.println("<tr><th>Ticket ID</th><th>User</th><th>Event</th>"
                          + "<th>No. of Tickets</th><th>Booking Date</th></tr>");

                while (rs.next()) {
                    out.println("<tr><td>" + rs.getInt("ticket_id") + "</td><td>"
                              + rs.getString("user_name") + "</td><td>"
                              + rs.getString("event_name") + "</td><td>"
                              + rs.getInt("num_tickets") + "</td><td>"
                              + rs.getTimestamp("booking_date") + "</td></tr>");
                }
                out.println("</table>");
                rs.close();
                stmt.close();
            } else {
                out.println("<h3>Booking failed. Please try again.</h3>");
            }
            ps.close();

        } catch (ClassNotFoundException e) {
            out.println("Driver not found: " + e);
        } catch (SQLException e) {
            out.println("Database error: " + e);
        } finally {
            try { if (con != null) con.close(); } catch (SQLException e) {}
            out.close();
        }
    }
}
