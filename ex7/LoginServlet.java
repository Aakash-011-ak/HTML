import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

@WebServlet("/LoginServlet")
public class LoginServlet extends HttpServlet {
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        response.setContentType("text/html");
        PrintWriter out = response.getWriter();
        
        // Capture any dynamic input provided by the user
        String user = request.getParameter("username");
        String pass = request.getParameter("password");
        
        if (user != null && !user.trim().isEmpty()) {
            
            // Create session and store the dynamic user input
            HttpSession session = request.getSession();
            session.setAttribute("user", user);
            
            // Retrieve unique visitor count from ServletContext
            Integer visitorCount = (Integer) getServletContext().getAttribute("visitorCount");
            if (visitorCount == null) visitorCount = 1;

            out.println("<!DOCTYPE html><html><head><title>Dashboard</title>");
            out.println("<style>");
            out.println("body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #74b9ff, #0984e3); height: 100vh; display: flex; justify-content: center; align-items: center; margin: 0; }");
            out.println(".dashboard { background: #ffffff; padding: 40px; border-radius: 12px; width: 450px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2); }");
            out.println("h2 { color: #2d3436; margin-bottom: 10px; font-size: 24px; text-align: center; }");
            out.println("p { color: #636e72; font-size: 15px; margin-bottom: 15px; text-align: center; }");
            out.println(".success { color: #00b894; font-weight: 600; text-align: center; margin-bottom: 15px; }");
            out.println("hr { border: 0; height: 1px; background: #dfe6e9; margin: 20px 0; }");
            out.println("h3 { color: #2d3436; font-size: 16px; margin-bottom: 10px; }");
            out.println("input[type='submit'] { background-color: #0984e3; color: white; border: none; padding: 10px 15px; width: 100%; border-radius: 6px; cursor: pointer; font-size: 14px; font-weight: 600; transition: background-color 0.3s ease; }");
            out.println("input[type='submit']:hover { background-color: #74b9ff; }");
            out.println("a { display: block; text-align: center; background-color: #00b894; color: white; padding: 10px 15px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 600; transition: background-color 0.3s ease; margin-bottom: 10px; }");
            out.println("a:hover { background-color: #55efc4; }");
            out.println("</style>");
            out.println("</head><body><div class='dashboard'>");
            out.println("<h2>Welcome, " + user + "!</h2>");
            out.println("<p class='success'>Login Successful!</p>");
            out.println("<p><b>Total Unique Visitors: " + visitorCount + "</b></p><hr>");
            
            // 1. Hidden Form Field Demonstration (Passing dynamic user input)
            out.println("<h3>Method 1: Hidden Form Field</h3>");
            out.println("<form action='HiddenFieldServlet' method='post'>");
            out.println("<input type='hidden' name='hiddenUser' value='" + user + "'>");
            out.println("<input type='submit' value='Go via Hidden Field'>");
            out.println("</form><br>");
            
            // 2. URL Rewriting Demonstration (Passing dynamic user input)
            out.println("<h3>Method 2: URL Rewriting</h3>");
            out.println("<a href='URLRewriteServlet?username=" + user + "'>Click here to go via URL Rewriting</a>");
            
            // 3. Cookie Demonstration (New)
            out.println("<h3>Method 3: Cookies</h3>");
            out.println("<a href='CookieServlet?username=" + user + "'>Click here to go via Cookies</a>");
            
            out.println("</div></body></html>");
        } else {
            out.println("<!DOCTYPE html><html><head><title>Error</title>");
            out.println("<style>body{font-family:'Segoe UI',sans-serif;background:linear-gradient(135deg,#74b9ff,#0984e3);height:100vh;display:flex;justify-content:center;align-items:center;margin:0;}");
            out.println(".error-box{background:#fff;padding:30px;border-radius:12px;text-align:center;width:350px;box-shadow:0 10px 25px rgba(0,0,0,0.2);}");
            out.println("h3{color:#d63031;margin-bottom:20px;} a{color:#0984e3;text-decoration:none;font-weight:600;}</style>");
            out.println("</head><body><div class='error-box'>");
            out.println("<h3>Please enter a valid username!</h3>");
            out.println("<a href='index.html'>Try Again</a>");
            out.println("</div></body></html>");
        }
    }
}
