import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet("/CookieServlet")
public class CookieServlet extends HttpServlet {
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        response.setContentType("text/html");
        PrintWriter out = response.getWriter();
        
        // Capture username from request parameter if passed and create/update the cookie
        String user = request.getParameter("username");
        if (user != null && !user.trim().isEmpty()) {
            Cookie userCookie = new Cookie("userCookie", user);
            userCookie.setMaxAge(60 * 60 * 24); // Set cookie expiration to 1 day
            response.addCookie(userCookie);
        }
        
        // Retrieve cookies from the request
        Cookie[] cookies = request.getCookies();
        String retrievedUser = "Guest";
        
        if (cookies != null) {
            for (Cookie cookie : cookies) {
                if ("userCookie".equals(cookie.getName())) {
                    retrievedUser = cookie.getValue();
                    break;
                }
            }
        }
        
        out.println("<!DOCTYPE html><html><head><title>Cookie Result</title>");
        out.println("<style>");
        out.println("body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #74b9ff, #0984e3); height: 100vh; display: flex; justify-content: center; align-items: center; margin: 0; }");
        out.println(".box { background: #ffffff; padding: 40px; border-radius: 12px; width: 450px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2); text-align: center; }");
        out.println("h2 { color: #2d3436; margin-bottom: 15px; }");
        out.println("p { color: #636e72; font-size: 16px; margin-bottom: 20px; }");
        out.println("a { background-color: #0984e3; color: white; padding: 10px 15px; border-radius: 6px; text-decoration: none; font-weight: 600; display: inline-block; }");
        out.println("</style>");
        out.println("</head><body><div class='box'>");
        out.println("<h2>Cookie Tracking Result</h2>");
        out.println("<p>Username retrieved from Cookie: <b>" + retrievedUser + "</b></p>");
        out.println("<a href='index.html'>Home</a>");
        out.println("</div></body></html>");
    }

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        doGet(request, response);
    }
}
