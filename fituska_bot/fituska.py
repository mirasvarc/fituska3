import discord
import os
import requests
import asyncio
from quart import Quart, request
import json

app = Quart(__name__)

client = discord.Client()


@app.before_serving
async def before_serving():
    loop = asyncio.get_event_loop()
    await client.login('ODEyMzMzMjk2MDI4ODc2ODEx.YC_OVg.YUHowf7VO3ZDunRpU6e2D4oOhUQ')
    loop.create_task(client.connect())


@app.route("/send", methods=["POST"])
async def send_message():

    channel = client.get_channel(821828287406800916)

    course = await request.get_json()
    embed = discord.Embed(title='['+ course["course"] +'] ' + course["post"]["title"])
    msg = course["post"]["content"]
    embed.add_field(name=course["author"], value=msg, inline=False)

    await channel.send(embed=embed)
    return 'OK', 200

@app.route("/sendDCMsg", methods=["POST"])
async def send_dc_message():

    data = await request.get_json()
    channel = client.get_channel(data['channel'])

    embed = discord.Embed(title='Hromadná zpráva')
    msg = data['content']

    embed.add_field(name=data["author"], value=msg, inline=False)

    await channel.send(embed=embed)
    return 'OK', 200

@client.event
async def on_ready():
    print('We have logged in as {0.user}'.format(client))

@client.event
async def on_message(message):
    if message.author == client.user:
        return

    if message.content.startswith('$fituska') or client.user.mentioned_in(message):
        if len(str(message.content).split(" ")) == 1:
            await message.channel.send('Ahoj, mé jméno je FITuška.\nJestli chceš ukázat, co všechno umím, napiš příkaz $fituska help nebo @FITuška help.')
            return
        elif len(str(message.content).split(" ")) == 2:
            if str(message.content.split(" ")[1]) == "help":
                await message.channel.send('HELP!') #TODO: help (in embed probably)
                return
            else:
                await message.channel.send('Neznámý příkaz.')
                return
        else:
            await message.channel.send('Neznámý příkaz.')
            return

    if str(message.content).split(" ")[0] == "$getuser":

        if len(str(message.content).split(" ")) != 2:
            await message.channel.send("Zadej id uživatele!")
            return

        id = str(message.content.split(" ")[1])
        r = requests.get("http://localhost:8000/api/user/get/{id}".format(id = id))
        data = r.json()
        await message.channel.send(
            "Username: %s\nJméno: %s\nPříjmení: %s\n"%(data['username'], data['first_name'], data['surname'])
        )

    if str(message.content).split(" ")[0] == "$getposts":

        if len(str(message.content).split(" ")) != 2:
            await message.channel.send("Zadej zkratku předmětu")
            return

        subject_code = str(message.content.split(" ")[1])
        r = requests.get("http://localhost:8000/api/posts/get/{code}".format(code = subject_code))


        try:
            data = r.json()

            embed = discord.Embed(title='Příspěvky')

            msg = ""
            for post in data:
                msg += "#" + str(post['id']) + " " + str(post['title']) + '\n'
                #msg += "#" + str(post['id']) + " [" + str(post['title']) + "](http://localhost:8000/post/" + subject_code  + "/" + str(post['id']) + ")" + '\n'

            embed.add_field(name="Seznam příspěvků", value=msg, inline=False)

            await message.channel.send(embed=embed)

        except:
            await message.channel.send("Neznámá zkratka předmětu.")
            return

    if str(message.content).split(" ")[0] == "$getpost":

        if len(str(message.content).split(" ")) != 2:
            await message.channel.send("Zadej id příspěvku")
            return

        id = str(message.content.split(" ")[1])
        r = requests.get("http://localhost:8000/api/post/get/{id}".format(id = id))

        try:
            data = r.json()

            embed = discord.Embed(title='Příspěvek #' + id)

            #title += "#" + str(post['id']) + " [" + str(post['title']) + "](http://localhost:8000/post/" + subject_code  + "/" + str(post['id']) + ")" + '\n'
            text = str(data['content']) #TODO: format html

            embed.add_field(name=data['title'], value=text, inline=False)

            await message.channel.send(embed=embed)

        except:
            await message.channel.send("Neznámý příspěvek.")
            return

    if str(message.content).split(" ")[0] == "$addpost":

        course = str(message.content).split(" ")[1]
        content = str(message.content).split(" ")[2]

        await message.channel.send("Adding post")
        await message.channel.send(content)
        #r = requests.get("http://localhost:8000/api/post/get/{id}".format(id = id))



app.run()
