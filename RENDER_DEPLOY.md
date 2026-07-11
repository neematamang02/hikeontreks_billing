# Deploying HikeOnTreks Billing to Render (Docker + your existing cPanel MySQL)

Render has no native PHP runtime, so this app deploys as a **Docker web service**.
Your database stays exactly where it is (cPanel/phpMyAdmin) — Render connects to it
remotely over the internet.

Files added for this: `Dockerfile`, `.dockerignore`, `deploy/render-entrypoint.sh`, `render.yaml`.

---

## Step 0 — One-time cPanel change: allow Render to reach your database

1. In cPanel, open **Remote MySQL**.
2. You'll add Render's outbound IP range here — but you only get that IP **after**
   you create the Render service (Step 2), so come back to this after Step 2.
3. Also confirm in **MySQL Databases** that your DB user (`wscnigyr_billing_user`
   or whatever you're using) has **ALL PRIVILEGES** on the database.

If your host has "Remote MySQL" totally disabled/greyed out with no way to add IPs,
external connections aren't possible on that plan — you'd need to ask your host to
enable it, or move the DB to a host that allows remote access.

## Step 1 — Push this project to GitHub

```bash
cd hikeontreks_billingbs6
git remote remove origin        # this had your old GitLab remote
git add .
git commit -m "Add Docker/Render deployment config"
```

Create a new **empty** GitHub repo (no README/license), then:

```bash
git remote add origin https://github.com/<your-username>/<repo-name>.git
git branch -M main
git push -u origin main
```

⚠️ Before pushing, double check `.env` is NOT in the commit (it's gitignored, but
verify with `git status` — you don't want live credentials in a public/private repo).

## Step 2 — Create the Web Service on Render

1. Go to the Render Dashboard → **New +** → **Web Service**.
2. Connect your GitHub account and select the repo you just pushed.
3. Render should auto-detect the `Dockerfile`. If asked:
   - **Runtime**: Docker
   - **Region**: pick one close to your users
   - **Instance type**: Starter is fine to begin
4. Don't deploy yet — first add the environment variables below.

### Environment variables (Render dashboard → Environment)

| Key | Value |
|---|---|
| `APP_NAME` | `HikeOnTreks\|Billing` |
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `APP_URL` | `https://<your-service>.onrender.com` (update after first deploy) |
| `APP_KEY` | `base64:uHFVYWN4azmKOqVCSe6vZVwUvCuaCzNYrBgI52cLE88=` |
| `DB_CONNECTION` | `mysql` |
| `DB_HOST` | your cPanel MySQL host (often your domain or server hostname — ask your host if `localhost` doesn't work externally) |
| `DB_PORT` | `3306` |
| `DB_DATABASE` | your cPanel DB name |
| `DB_USERNAME` | your cPanel DB user |
| `DB_PASSWORD` | your cPanel DB password |
| `SESSION_DRIVER` | `file` |
| `CACHE_DRIVER` | `file` |
| `QUEUE_CONNECTION` | `sync` |
| `LOG_LEVEL` | `error` |

The `APP_KEY` above was freshly generated for you — it's safe to use as-is, just don't reuse it elsewhere.

5. Click **Create Web Service**. The first build will run (installs Composer +
   npm deps, builds the image). This can take 5-10 minutes.

## Step 3 — Whitelist Render's IP in cPanel Remote MySQL

1. Once the service exists, go to its page → **Connect** button → **Outbound** tab.
   Copy the listed IP range (a CIDR block, e.g. `xxx.xxx.xxx.0/24`).
2. Back in cPanel → **Remote MySQL** → add that range as an allowed host.
3. Redeploy (or trigger **Manual Deploy** → **Deploy latest commit**) so the
   container's first `php artisan migrate` can actually reach the database.

## Step 4 — Watch the deploy logs

In Render → your service → **Logs**, you should see the entrypoint script run:
migrations, config cache, route cache. If the DB connection fails, you'll see it
here — double-check `DB_HOST`/credentials and that Step 3's IP whitelist saved.

## Step 5 — Verify it's live

Visit `https://<your-service>.onrender.com` — you should hit the `/login` page.
Log in with an existing admin account from your current database (your data is
already there since you're using the same DB).

## Step 6 (optional) — Custom domain

Render → your service → **Settings** → **Custom Domains** → add your domain, then
update the DNS records it gives you at your domain registrar. Once added, update
`APP_URL` to match and redeploy.

---

## Notes / gotchas specific to this project

- **Free/Starter plan services on Render spin down when idle** and cold-start on
  the next request (~30-50s delay). If that's a problem for a billing app your
  team uses daily, use at least the Starter *paid* plan (no spin-down).
- **File uploads**: checked your controllers — this app doesn't currently write
  any uploaded files to local disk, so Render's ephemeral filesystem isn't a
  concern here. If you add file uploads later, route them to S3 (or similar)
  rather than local storage, since anything written locally is wiped on redeploy.
- Migrations run automatically on every deploy (`RUN_MIGRATIONS=true` in
  `render.yaml`). Set that env var to `false` in the dashboard if you'd rather run
  `php artisan migrate --force` manually via Render's **Shell** tab.
