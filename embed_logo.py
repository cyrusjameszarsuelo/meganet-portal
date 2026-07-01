import base64
import os

proj = "/Users/cyrusjameszarsuelo/Documents/megawide/meganet-portal/Meganet Portal New"

# Read and encode the image
with open(os.path.join(proj, "public/images/ictime.png"), "rb") as f:
    b64 = base64.b64encode(f.read()).decode("ascii")

data_uri = "data:image/png;base64," + b64
old_src = "https://meganet.portalwebsite.net/images/ictime.png"

templates = [
    "resources/views/emails/star-appreciation-giver-valid.blade.php",
    "resources/views/emails/star-appreciation-giver-not-valid.blade.php",
    "resources/views/emails/star-appreciation-receiver-valid.blade.php",
    "resources/views/emails/star-appreciation-receiver-not-valid.blade.php",
]

for tmpl in templates:
    path = os.path.join(proj, tmpl)
    with open(path, "r") as f:
        content = f.read()
    if old_src in content:
        updated = content.replace(old_src, data_uri)
        with open(path, "w") as f:
            f.write(updated)
        print("Updated:", tmpl)
    else:
        print("No match found in:", tmpl)

print("Done.")
