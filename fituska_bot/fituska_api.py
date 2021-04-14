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

app.run()
