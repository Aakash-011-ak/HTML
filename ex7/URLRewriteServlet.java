import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet("/URLRewriteServlet")
public class URLRewriteServlet extends HttpServlet {
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        response.setContentType("text/html");
        PrintWriter out = response.getWriter();
        
        // Extracting data appended directly to the query string parameter
        String username = request.getParameter("username");
        
        out.println("<!DOCTYPE html><html><head><title>URL Rewriting Result</title>");
        out.println("<style>");
        out.println("body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #74b9ff, #0984e3); height: 100vh; display: flex; justify-content: center; align-items: center; margin: 0; }");
        out.println(".box { background: #ffffff; padding: 40px; border-radius: 12px; width: 400px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2); text-align: center; }");
        out.println("h2 { color: #2d3436; margin-bottom: 15px; font-size: 24px; }");
        out.println("p { color: #636e72; font-size: 15px; margin-bottom: 15px; }");
        out.println("a { display: inline-block; background-color: #0984e3; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 600; transition: background-color 0.3s ease; }");
        out.println("a:hover { background-color: #74b9ff; }");
        out.println("</style>");
        out.println("</head><body><div class='box'>");
        out.println("<h2>URL Rewriting Tracking</h2>");
        out.println("<p>Hello, <b>" + username + "</b>!</p>");
        out.println("<p style='color:#666;font-size:14px;'>(This username was captured directly from the query parameter in the browser's address bar.)</p>");
        out.println("<br><a href='index.html'>Logout / Home</a>");
        out.println("</div></body></html>");
    }
}
