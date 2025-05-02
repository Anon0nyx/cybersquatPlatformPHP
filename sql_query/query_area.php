<div id="editor-container">
  <textarea id="query-editor" name="query" placeholder="Write your SQL query here"></textarea>
</div>

<!-- Include CodeMirror Library for Syntax Highlighting -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.12/codemirror.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.12/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.12/mode/sql/sql.min.js"></script>

<script>
  // Initialize CodeMirror for SQL Syntax Highlighting
  const textarea = document.getElementById('query-editor');
  const editor = CodeMirror.fromTextArea(textarea, {
    mode: "text/x-sql", // SQL mode for syntax highlighting
    lineNumbers: true, // Enable line numbers
    theme: "default",  // You can replace with other themes like "monokai"
    indentWithTabs: true,
    tabSize: 2,
    autofocus: true // Automatically focus the editor on page load
  });

  // Sync CodeMirror content to the textarea before form submission
  const form = document.querySelector('form');
  form.addEventListener('submit', function () {
    textarea.value = editor.getValue(); // Sync content back to the textarea
  });
</script>

<style>
  /* Style for CodeMirror Editor */
  #editor-container {
    display: flex;
    justify-content: center;
    margin: 20px auto;
    width: 90%; /* Center and responsive width */
  }

  .CodeMirror {
    font-size: 16px; /* Increase font size for readability */
    font-family: 'Courier New', Courier, monospace; /* Monospace for SQL */
    border: 1px solid #ccc;
    border-radius: 5px;
    height: 700px; /* Editor height */
    width: 1250px; /* Fixed width for the editor */
    background-color: #f9f9f9; /* Subtle background color */
    margin-bottom: 15px;
    padding: 5px;
  }

  /* Optional: Customize the placeholder text for the editor */
  textarea#query-editor {
    display: none; /* Hide the original textarea (replaced by CodeMirror) */
  }
</style>
